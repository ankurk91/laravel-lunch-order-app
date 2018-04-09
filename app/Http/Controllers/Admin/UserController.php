<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileUpdateRequest;
use App\Http\Requests\User\StoreRequest as UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('profile')
            ->where('id', '!=', auth()->user()->id);

        if ($request->filled('search')) {
            $users->where('email', 'like', '%' . $request->input('search') . '%');

            $users->orWhereHas('profile', function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('last_name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('primary_phone', 'like', '%' . $request->input('search') . '%');

            });
        }

        if ($request->filled('active_status')) {
            if ($request->input('active_status') === 'active') {
                $users->active();
            } elseif ($request->input('active_status') === 'blocked') {
                $users->blocked();
            }
        } else {
            // Load only active users by default
            $users->active();
        }

        $users = $users->latest()
            ->paginate($request->filled('per_page') ? $request->input('per_page') : 10);


        return view('admin.users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $availableRoles = Role::all();
        return view('admin.users.create', compact('availableRoles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        DB::beginTransaction();

        $user = new User();
        $user = $user->create($request->only([
            'email',
        ]));
        $user->profile()->create($request->only([
            'first_name', 'last_name', 'primary_phone'
        ]));
        $user->assignRole($request->input('roles'));

        DB::commit();
        //todo send invite
        alert()->success('User was created successfully.');
        return redirect()->route('admin.users.edit', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load(['profile', 'roles']);
        $availableRoles = Role::all();
        return view('admin.users.edit', compact('user', 'availableRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfileUpdateRequest $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request, User $user)
    {
        UserProfile::updateOrCreate(
            ['user_id' => $user->id],
            $request->only(
                ['first_name', 'last_name', 'primary_phone']
            )
        );

        alert()->success('User profile was updated successfully.');
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function updateRoles(Request $request, User $user)
    {
        $this->validate($request, [
            'roles' => 'bail|required|array|exists:roles,id',
        ]);

        $user->syncRoles($request->input('roles'));

        alert()->success('User roles were updated successfully.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //todo check for purchase history before deleting
        $user->delete();
        alert()->success('User was deleted successfully.');
        return redirect()->route('admin.users.index');
    }

    /**
     * Toggle user's account locked status.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleBlockedStatus(User $user)
    {
        $user->blocked_at = $user->is_blocked ? null : now();
        $user->save();

        alert()->success('User status was changed successfully.');
        return back();
    }

    /**
     * Send password reset email to user.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendPasswordResetEmail(User $user)
    {
        Password::sendResetLink(['email' => $user->getEmailForPasswordReset()]);

        alert()->success('Password reset email was sent successfully.');
        return back();
    }


}
