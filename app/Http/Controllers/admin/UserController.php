<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('iduser')->get(); // Hanya ambil data user
        return view('admin.user.index', compact('users'));
    }


    public function create()
    {
        return view('admin.user.create');
    }


    public function store(Request $request)
    {
        $validated = $this->validateUser($request);
        $this->createUser($validated);

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
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

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->deleted_by = auth()->id();
        $user->save();

        $user->delete();

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil dihapus!');
    }

    private function validateUser(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . ($request->id ?? 'NULL') . ',iduser',
            'password' => $request->isMethod('post') ? 'required|string|min:6' : 'nullable|string|min:6',
        ]);
    }


    private function createUser(array $data)
    {
        return User::create([
            'nama' => $this->formatNamaUser($data['nama']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    private function formatNamaUser($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
