<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserBlockedStatusChanged;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRolesUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class UserActionController extends Controller
{
    /**
     * Update the user's roles.
     *
     * @param  UserRolesUpdateRequest $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function updateRoles(UserRolesUpdateRequest $request, User $user)
    {
        $user->syncRoles($request->input('roles', []));

        alert()->success('User roles were updated successfully.');
        return back();
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

        event(new UserBlockedStatusChanged($user));

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
        Password::sendResetLink([
            'email' => $user->getEmailForPasswordReset()
        ]);

        alert()->success('Password reset email was sent successfully.');
        return back();
    }
}
