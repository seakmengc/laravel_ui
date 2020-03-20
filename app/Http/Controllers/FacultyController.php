<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyValidation;
use App\Models\Faculty;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class FacultyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Faculty::class);

        $faculties = Faculty::withTrashed()->get();

        return view('faculties.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Faculty::class);

        return view('faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(FacultyValidation $request)
    {
        $this->authorize('create', Faculty::class);

        $input = $request->validated();

        $faculty = Faculty::create($input);

        return redirect("/faculties/$faculty->id")
            ->with(['success' => "$faculty->name faculty created successfully."]);
    }

    /**
     * Display the specified resource.
     *
     * @param Faculty $faculty
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $faculty = Faculty::withTrashed()->findOrFail($id);

        $this->authorize('view', $faculty);

        $faculty->load('departments');

        return view('faculties.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Faculty $faculty
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Faculty $faculty)
    {
        $this->authorize('update', $faculty);

        return view('faculties.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Faculty $faculty
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(FacultyValidation $request, $id)
    {
        $faculty = Faculty::withTrashed()->findOrFail($id);

        $this->authorize('update', $faculty);

        $faculty->load('departments');

        $input = $request->validated();

        $faculty->update($input);

        return redirect("/faculties/$faculty->id")
            ->with(['success' => "$faculty->name faculty updated successfully."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Faculty $faculty
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Faculty $faculty)
    {
        $this->authorize('delete', $faculty);

        DB::beginTransaction();
        $faculty->departments()->each(function ($department) {
            $department->courses()->each(function ($course) {
                //Permanently delete enrolled students from the course
                $course->students()->delete();
                $course->taught_by = null;
                $course->saveOrFail();
                $course->delete();
            });
            $department->delete();
        });
        $faculty->delete();
        DB::commit();

        return redirect('/faculties')
            ->with(['success' => "$faculty->name faculty deleted successfully."]);
    }

    public function restore($id)
    {
        $faculty = Faculty::withTrashed()->findOrFail($id);

        $this->authorize('restore', $faculty);

        $faculty->restore();

        return redirect(route('faculties.show', $faculty->id))
            ->with(['success' => "$faculty->name faculty restored successfully."]);
    }
}
