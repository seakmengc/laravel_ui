<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterValidation;
use App\Http\Requests\UserValidation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::withTrashed()->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        $role_names = Role::all()->except(Role::findByName('admin')->id)
            ->pluck('name');

        return view('users.create', compact('role_names'));
    }

    public function store(RegisterValidation $request)
    {
        $this->authorize('create', User::class);

        DB::beginTransaction();

        $user = User::create($request->validatedUserData());
        $user->syncRoles($request->validatedRolesData());
        $user->identity()->create($request->validatedIdentityData());

        DB::commit();

        return redirect("/users/$user->id")
            ->with(['success' => "User $user->username registered successfully."]);
    }

    public function show($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $this->authorize('view', $user);

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    public function update(UserValidation $request, User $user)
    {
        $this->authorize('update', $user);

        if (password_verify($request['old_password'], $user->password))
            return redirect()->back()->withErrors(['old_password' => 'Your password does not match.'])
                ->withInput($request->all());

        $input = $request->validated();

        $user->update($input);

        return redirect("/users/$user->id")
            ->with(['success' => "User $user->username updated successfully."]);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        DB::beginTransaction();
        $user->courses_teaching()->each(function ($course) {
            $course->taught_by = null;
            $course->save();
        });
        $user->courses_taking()->delete();
        $user->user_roles()->delete();
        $user->identity()->delete();
        $user->delete();
        DB::commit();

        //Should redirect to other page
        return redirect(route('users.show', $user->id))
            ->with(['success' => "User $user->username removed successfully."]);
    }

    public function confirm_restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        $this->authorize('restore', $user);

        return view('users.restore', compact('user'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        $this->authorize('restore', $user);

        DB::beginTransaction();
        $user->identity()->restore();
        $user->restore();
        DB::commit();

        return redirect(route('users.show', $user->id))
            ->with(['success' => "User $user->username restored successfully."]);
    }

    public function getUser($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user,200);
    }
}
