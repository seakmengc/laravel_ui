<?php

namespace App\Policies;

use App\Models\StudentCourse;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use function foo\func;

class StudentCoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the student course.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StudentCourse  $studentCourse
     * @return mixed
     */
    public function view(User $user, StudentCourse $studentCourse)
    {
        return $user->can('view student_courses');
    }

    /**
     * Determine whether the user can create student courses.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create student_courses');
    }

    /**
     * Determine whether the user can delete the student course.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\StudentCourse  $studentCourse
     * @return mixed
     */
    public function delete(User $user, StudentCourse $studentCourse)
    {
        return $user->can('delete student_courses');

    }
}
