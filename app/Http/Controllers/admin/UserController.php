<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->orderBy('iduser')->get();
        $roles = Role::all();
        return view('admin.user.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:6',
            'idrole' => 'nullable|exists:role,idrole'
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->idrole) {
            $user->roles()->attach($request->idrole, ['status' => 1]);
        }

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dibuat.');
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => "required|email|unique:user,email,{$id},iduser",
            'password' => 'nullable|string|min:6',
            'idrole' => 'nullable|exists:role,idrole'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password
                ? Hash::make($request->password)
                : $user->password,
        ]);

        // Update role pivot
        if ($request->idrole) {
            $user->roles()->sync([$request->idrole => ['status' => 1]]);
        } else {
            $user->roles()->detach();
        }

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
    }
}
