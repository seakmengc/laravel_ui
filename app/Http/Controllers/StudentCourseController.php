<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\StudentCourseValidation;
use App\Models\StudentCourse;
use App\Models\User;

class StudentCourseController extends Controller
{
    public function create(User $user)
    {
        $this->authorize('create', StudentCourse::class);

        $excludes = array();
        $raw_ex = StudentCourse::select('course_id')->where('user_id', $user->id)->get();
        foreach ($raw_ex as $ex)
            $excludes[] = $ex['course_id'];

        $courses = Helper::getCoursesInKeyValue($excludes);

        return view('student_courses.create', compact(['courses', 'user']));
    }

    public function store(StudentCourseValidation $request, User $user)
    {
        $this->authorize('create', StudentCourse::class);

        $input = $request->validated();
        $input['user_id'] = $user->id;

        StudentCourse::create($input);

        return redirect('/users/' . $user->id);
    }

    public function destroy(StudentCourse $student_course)
    {
        $this->authorize('delete', $student_course);

        $student_course->delete();

        return redirect("/users/" . $student_course->user_id);
    }
}
