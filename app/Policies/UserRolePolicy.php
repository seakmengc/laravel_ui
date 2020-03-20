<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserRolePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the user role.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserRole  $userRole
     * @return mixed
     */
    public function view(User $user, UserRole $userRole)
    {
        return $user->can('view user_roles');
    }

    /**
     * Determine whether the user can create user roles.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create user_roles');
    }

    /**
     * Determine whether the user can delete the user role.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserRole  $userRole
     * @return mixed
     */
    public function delete(User $user, UserRole $userRole)
    {
        return $user->can('delete user_roles');
    }
}
