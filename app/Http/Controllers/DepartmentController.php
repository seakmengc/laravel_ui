<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\DepartmentValidation;
use App\Models\Department;
use App\Models\Faculty;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use PHPUnit\TextUI\Help;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $this->authorize('viewAny', Department::class);

        $departments = Department::withTrashed()->with('faculty')->get();

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $this->authorize('create', Department::class);

        $faculties = Helper::getFacultiesInKeyValue();

        return view('departments.create', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentValidation $request
     * @return Redirector
     */
    public function store(DepartmentValidation $request)
    {
        $this->authorize('create', Department::class);

        $input = $request->validated();

        $department = Department::create($input);

        return redirect("/departments/$department->id")
            ->with(['success' => "$department->name department created successfully."]);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return View
     */
    public function show($id)
    {
        $department = Department::withTrashed()->with('faculty')->findOrFail($id);

        $this->authorize('view', $department);

        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function edit($id)
    {
        $department = Department::withTrashed()->with('faculty')->findOrFail($id);

        $this->authorize('update', $department);

        //Want to get key-value pairs of array for selecting a faculty
        $faculties = Helper::getFacultiesInKeyValue();

        return view('departments.edit', compact(['department', 'faculties']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentValidation $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(DepartmentValidation $request, $id)
    {
        $department = Department::withTrashed()->with('faculty')->findOrFail($id);

        $this->authorize('update', $department);

        $input = $request->validated();

        $department->update($input);

        return redirect(route('departments.show', $department->id))
            ->with(['success' => "$department->name department updated successfully."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy(Department $department)
    {
        $this->authorize('delete', $department);

        DB::beginTransaction();
        $department->courses()->each(function ($course) {
            $course->students()->delete();
            $course->taught_by = null;
            $course->saveOrFail();
            $course->delete();
        });
        $department->delete();
        DB::commit();

        return redirect('/departments')
            ->with(['success' => "$department->name department deleted successfully."]);
    }

    public function restore($id)
    {
        $department = Department::onlyTrashed()->findOrFail($id);

        $this->authorize('restore', $department);

        DB::beginTransaction();
        $department->faculty()->restore();
        $department->restore();
        DB::commit();

        return redirect(route('departments.show', $department->id))
        ->with(['success' => "$department->name department restored successfully."]);
    }
}
