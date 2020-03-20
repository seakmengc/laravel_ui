<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any roles.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can view the role.
     *
     * @param \App\Models\User $user
     * @param Role $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        if($role->name == 'admin')
            return false;

        return $user->can('view roles')
            || $user->hasRole($role);
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create roles');
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        if($role->name == 'admin')
            return false;

        return $user->can('edit roles');
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\Models\User  $user
     * @param  \Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        if($role->name == 'admin')
            return false;

        return $user->can('delete roles');
    }
}
