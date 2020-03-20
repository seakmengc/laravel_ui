<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseValidation;
use App\Models\Course;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // if (Gate::denies('viewAny-course'))
        //     abort(403);
        $this->authorize('viewAny', Course::class);

        $courses = Course::withTrashed()->with('department', 'instructor')->get();

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Course::class);

        $users = Helper::getUsersInKeyValue();
        $departments = Helper::getDepartmentsInKeyValue();
        $instructors = Helper::getInstructorsInKeyValue();

        return view('courses.create', compact(['users', 'departments', 'instructors']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CourseValidation $request)
    {
        $this->authorize('create', Course::class);

        $input = $request->validated();

        $course = Course::create($input);

        return redirect("/courses/$course->id")
            ->with(['success' => "$course->name course created successfully."]);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $course = Course::withTrashed()->findOrFail($id);

        $this->authorize('view', $course);

        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $course = Course::withTrashed()->findOrFail($id);

        $this->authorize('update', $course);

        $users = Helper::getUsersInKeyValue();
        $departments = Helper::getDepartmentsInKeyValue();
        $instructors = Helper::getInstructorsInKeyValue();

        return view('courses.edit', compact(['course', 'departments', 'users', 'instructors']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CourseValidation $request, $id)
    {
        $course = Course::withTrashed()->findOrFail($id);

        $this->authorize('update', $course);

        $input = $request->validated();

        $course->update($input);

        return redirect("/courses/$course->id")
            ->with(['success' => "$course->name course updated successfully."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);

        DB::beginTransaction();
        $course->students()->delete();
        $course->taught_by = null;
        $course->saveOrFail();
        $course->delete();
        DB::commit();

        return redirect('/courses')
            ->with(['success' => "$course->name course deleted successfully."]);
    }

    public function restore($id)
    {
        $course = Course::onlyTrashed()->findOrFail($id);

        $this->authorize('restore', $course);

        DB::beginTransaction();
        $department = $course->department;
        $department->faculty->restore();
        $department->restore();
        $course->restore();
        DB::commit();

        return redirect(route('courses.show', $course->id))
            ->with(['success' => "$course->name course restored successfully."]);

    }

}
