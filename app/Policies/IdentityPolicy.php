<?php

namespace App\Policies;

use App\Models\Identity;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IdentityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any identities.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can view the identity.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Identity  $identity
     * @return mixed
     */
    public function view(User $user, Identity $identity)
    {
        return $user->can('view identities') || $identity->user_id == $user->id;
    }

    /**
     * Determine whether the user can create identities.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create identities');
    }

    /**
     * Determine whether the user can update the identity.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Identity  $identity
     * @return mixed
     */
    public function update(User $user, Identity $identity)
    {
        return $user->can('edit identities') || $identity->user_id == $user->id;

    }

    /**
     * Determine whether the user can delete the identity.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Identity  $identity
     * @return mixed
     */
    public function delete(User $user, Identity $identity)
    {
        return $user->can('delete identities');

    }
}
