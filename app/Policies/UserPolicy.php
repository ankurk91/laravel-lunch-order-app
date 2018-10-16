<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can manage other users.
     *
     * @param  \App\Models\User $authUser
     * @param  \App\Models\User $user
     * @return mixed
     */
    protected function hasPermission(User $authUser, User $user)
    {
        return $user->isNot($authUser);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User $authUser
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function update(User $authUser, User $user)
    {
        return $this->hasPermission($authUser, $user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User $authUser
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function delete(User $authUser, User $user)
    {
        return $this->hasPermission($authUser, $user);
    }

    /**
     * Determine whether the user can update roles for the model.
     *
     * @param  \App\Models\User $authUser
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function updateRoles(User $authUser, User $user)
    {
        return $this->hasPermission($authUser, $user);
    }

    /**
     * Determine whether the user can toggle block status for the model.
     *
     * @param  \App\Models\User $authUser
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function toggleBlock(User $authUser, User $user)
    {
        return $this->hasPermission($authUser, $user);
    }

    /**
     * Determine whether the user can send password reset email for the model.
     *
     * @param  \App\Models\User $authUser
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function passwordResetEmail(User $authUser, User $user)
    {
        return $this->hasPermission($authUser, $user);
    }
}
