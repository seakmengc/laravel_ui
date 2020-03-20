<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\UserRoleValidation;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $user_roles = UserRole::all();

        return view('user_roles.index', compact('user_roles'));
    }

    public function create($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $excludes = array();
        $raw_ex = $user->getRoleNames();
        foreach ($raw_ex as $ex)
            $excludes[] = Role::findByName($ex)['id'];
        $excludes[] = Role::findByName('admin')['id'];

        $roles = Helper::getRolesInKeyValue($excludes);

        return view('user_roles.create', compact(['roles', 'user']));
    }

    public function store(UserRoleValidation $request, $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $input = $request->validated();

        $user->assignRole($input);

        return redirect("/users/" . $user->id);
    }

    public function destroy($id, Role $role)
    {
        $user = User::withTrashed()->findOrFail($id);

        if ($role->name == 'instructor') {
            if (count($user->courses_teaching) != 0) {
                return redirect(route('users.show', $user->id))
                    ->with(['error' => 'Remove instructor from courses first!']);
            }
        } elseif ($role->name == 'student') {
            if (count($user->courses_taking) != 0) {
                return redirect(route('users.show', $user->id))
                    ->with(['error' => 'Un-enroll student from courses first!']);
            }
        }

        if (Gate::denies('delete-user_role', UserRole::where('role_id', $role->id)->where('model_id', $user->id)->first()))
            abort(403);

        $user->removeRole($role);

        return redirect(route('users.show', $user->id));
    }
}
