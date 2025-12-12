<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class ManajemenRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.manajemen_role.index', compact('users'));
    }

    public function edit($iduser)
    {
        $user = User::with('roles')->findOrFail($iduser);
        $roles = Role::all();
        $userRoles = $user->roles()->pluck('role_user.idrole', 'role_user.idrole_user')->toArray();
        $activeRoleId = $user->roles()->wherePivot('status', 1)->pluck('role_user.idrole')->first();

        return view('admin.manajemen_role.edit', compact('user', 'roles', 'userRoles', 'activeRoleId'));
    }

    public function update(Request $request, $iduser)
    {
        $user = User::findOrFail($iduser);

        $roles = $request->input('roles', []);
        $activeRole = $request->input('active_role');


        $user->roles()->detach();


        foreach ($roles as $roleId) {
            $user->roles()->attach($roleId, [
                'status' => $roleId == $activeRole ? 1 : 0
            ]);
        }

        return redirect()->route('admin.manajemen_role.index')->with('success', 'Role user berhasil diperbarui.');
    }
}
