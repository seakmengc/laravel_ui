<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Identity;
use App\Models\StudentCourse;
use App\Models\User;
use App\Models\UserRole;
use App\Policies\CoursePolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\FacultyPolicy;
use App\Policies\IdentityPolicy;
use App\Policies\RolePolicy;
use App\Policies\StudentCoursePolicy;
use App\Policies\UserPolicy;
use App\Policies\UserRolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Course::class => CoursePolicy::class,
        Faculty::class => FacultyPolicy::class,
        Department::class => DepartmentPolicy::class,
        Identity::class => IdentityPolicy::class,
        Role::class => RolePolicy::class,
        StudentCourse::class => StudentCoursePolicy::class,
        User::class => UserPolicy::class,
        UserRole::class => UserRolePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if($user->hasRole('admin'))
                return true;
        });
    }
}
