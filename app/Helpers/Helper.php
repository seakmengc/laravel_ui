<?php

namespace App\Helpers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\User;
use Spatie\Permission\Models\Role;

class Helper {
    public static function getUsersInKeyValue($excludes = [])
    {
        $raw_users = User::all()->except($excludes);

        $users = array();
        foreach ($raw_users as $u)
            $users[$u->id] = $u->username;

        return $users;
    }

    public static function getDepartmentsInKeyValue($excludes = [])
    {
        $raw_departments = Department::all()->except($excludes);

        $departments = array();
        foreach ($raw_departments as $d)
            $departments[$d->id] = $d->code . ': ' . $d->name;

        return $departments;
    }

    public static function getFacultiesInKeyValue($excludes = [])
    {
        $raw_faculties = Faculty::all()->except($excludes);

        //Want to get key-value pairs of array for selecting a faculty
        $faculties = array();
        foreach ($raw_faculties as $f) {
            $faculties[$f->id] = $f->name;
        }

        return $faculties;
    }

    public static function getRolesInKeyValue($excludes = [])
    {
        $raw_roles = Role::all()->except($excludes);

        $roles = array();
        foreach ($raw_roles as $r)
            $roles[$r->name] = $r->name;

        return $roles;
    }

    public static function getCoursesInKeyValue($excludes = [])
    {
        $raw_courses = Course::all()->except($excludes);

        $courses = array();
        foreach ($raw_courses as $c)
            $courses[$c->id] = $c->code . ': ' . $c->name;

        return $courses;
    }

    public static function getInstructorsInKeyValue($excludes = [])
    {
        $raw_ins = User::with('roles')->whereHas('roles', function ($q) {
            $q->where('name', 'instructor');
        })->get();

        $instructors = array();
        foreach ($raw_ins as $in)
            $instructors[$in->id] = $in->username;

        return $instructors;
    }
}
