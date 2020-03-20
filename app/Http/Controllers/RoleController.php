<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $admin = Role::findByName('admin');
        $roles = Role::all()->except($admin->id);

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        $raw_all_available_permissions = Permission::all()->pluck('name');
        $all_available_permissions = array();
        foreach ($raw_all_available_permissions as $available_permission)
            $all_available_permissions[explode(' ', $available_permission)[1]][]
                = explode(' ', $available_permission)[0];

        return view('roles.create', compact('all_available_permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RoleValidation $request)
    {
        $this->authorize('create', Role::class);

        DB::beginTransaction();

        $role = Role::create($request->validatedRoleData());

        $this->givePermissions($role, $request->validatedRolePermissions());

        DB::commit();

        return redirect("/roles/$role->id")
            ->with(['success' => "$role->name role created successfully."]);
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Role $role)
    {
        $this->authorize('view', $role);

        $permissions = array('users' => array(), 'faculties' => array(), 'departments' => array(),
            'courses' => array(), 'roles' => array(), 'user_roles' => array(), 'student_courses' => array(),
            'instructor_courses' => array());

        foreach ($role->permissions as $permission)
            $permissions[explode(' ', $permission->name)[1]][]
                = explode(' ', $permission->name)[0];

        if(count($role->permissions) == 0)
            $permissions = [];

        return view('roles.show', compact(['role', 'permissions']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        $raw_permissions = $role->permissions()->pluck('name');
        $permissions = array();
        foreach ($raw_permissions as $permission)
            $permissions[explode(' ', $permission)[1]][] = explode(' ', $permission)[0];

        $raw_all_available_permissions = Permission::all()->pluck('name');
        $all_available_permissions = array();
        foreach ($raw_all_available_permissions as $available_permission)
            $all_available_permissions[explode(' ', $available_permission)[1]][]
                = explode(' ', $available_permission)[0];

        return view('roles.edit', compact(['role', 'permissions', 'all_available_permissions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(RoleValidation $request, Role $role)
    {
        $this->authorize('update', $role);

        DB::beginTransaction();

        $role->update($request->validatedRoleData());

        $role->revokePermissionTo($role->permissions);

        $this->givePermissions($role, $request->validatedRolePermissions());

        DB::commit();

        return redirect("/roles/$role->id")
            ->with(['success' => "$role->name role updated successfully."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();

        return redirect('/roles')
            ->with(['success' => "$role->name role deleted successfully."]);
    }

    private function givePermissions(Role $role, $input) {
        foreach ($input as $key => $section)
            foreach ($section as $permission)
                $role->givePermissionTo($permission . ' ' . $key);
    }
}
