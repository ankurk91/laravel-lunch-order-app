<?php

namespace App\Http\Controllers\Admin;


use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\DeleteRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $users->where('email', 'ilike', '%' . $request->input('search') . '%');

            $users->orWhereHas('profile', function ($query) use ($request) {
                $query->where('first_name', 'ilike', '%' . $request->input('search') . '%')
                    ->orWhere('last_name', 'ilike', '%' . $request->input('search') . '%')
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

        if ($request->filled('role_name')) {
            $users->role($request->input('role_name'));
        }

        $users = $users->latest()
            ->paginate($request->input('per_page', 10));


        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));

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
     * @param  CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        DB::beginTransaction();

        $user = new User();
        $user->password = bcrypt(str_random(30));
        $user = $user->fill($request->only([
            'email',
        ]));
        $user->save();

        $user->profile()->create($request->only([
            'first_name', 'last_name', 'primary_phone'
        ]));
        $user->assignRole($request->input('roles'));

        DB::commit();
        event(new UserCreated($user));

        alert()->success('User was created successfully.');
        return redirect()->route('admin.users.edit', $user);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->loadMissing(['profile', 'roles']);
        $availableRoles = Role::all();
        return view('admin.users.edit', compact('user', 'availableRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        UserProfile::updateOrCreate([
            'user_id' => $user->id
        ],
            $request->only([
                'first_name', 'last_name', 'primary_phone'
            ])
        );

        alert()->success('User profile was updated successfully.');
        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(DeleteRequest $request, User $user)
    {
        $user->delete();
        alert()->success('User was deleted successfully.');
        return redirect()->route('admin.users.index');
    }

}
