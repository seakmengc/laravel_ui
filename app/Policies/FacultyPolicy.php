<?php

namespace App\Policies;

use App\Models\Faculty;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FacultyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any faculties.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can view the faculty.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faculty  $faculty
     * @return mixed
     */
    public function view(User $user, Faculty $faculty)
    {
        return $user->can('view faculties');
    }

    /**
     * Determine whether the user can create faculties.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create faculties');
    }

    /**
     * Determine whether the user can update the faculty.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faculty  $faculty
     * @return mixed
     */
    public function update(User $user, Faculty $faculty)
    {
        return $user->can('edit faculties');
    }

    /**
     * Determine whether the user can delete the faculty.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faculty  $faculty
     * @return mixed
     */
    public function delete(User $user, Faculty $faculty)
    {
        return $user->can('delete faculties');
    }

    /**
     * Determine whether the user can restore the faculty.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faculty  $faculty
     * @return mixed
     */
    public function restore(User $user, Faculty $faculty)
    {
        return $user->can('restore faculties');
    }

    /**
     * Determine whether the user can permanently delete the faculty.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faculty  $faculty
     * @return mixed
     */
    public function forceDelete(User $user, Faculty $faculty)
    {
        //
    }
}
