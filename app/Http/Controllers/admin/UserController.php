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

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateUser($request);
        $user = $this->createUser($validated);

        if (!empty($validated['idrole'])) {
            $user->roles()->attach($validated['idrole'], ['status' => 1]);
        }

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil ditambahkan.');
    }

    private function validateUser(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . ($request->id ?? 'NULL') . ',iduser',
            'password' => $request->isMethod('post') ? 'required|string|min:6' : 'nullable|string|min:6',
            'idrole' => 'nullable|exists:role,idrole'
        ]);
    }

    private function createUser(array $data)
    {
        $data['nama'] = $this->formatNamaUser($data['nama']);
        $data['password'] = Hash::make($data['password']);

        return User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => $data['password'],
            'idrole' => $data['idrole'],
        ]);
    }

    private function formatNamaUser($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateUser($request);
        $user = User::findOrFail($id);

        $updateData = [
            'nama' => $this->formatNamaUser($validated['nama']),
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        // Sinkronisasi role
        if (!empty($validated['idrole'])) {
            $user->roles()->sync([$validated['idrole'] => ['status' => 1]]);
        } else {
            $user->roles()->detach();
        }

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil dihapus.');
    }
}
