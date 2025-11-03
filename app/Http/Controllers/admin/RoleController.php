<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $data = Role::orderBy('idrole')->get();
        return view('admin.role.index', compact('data'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRole($request);
        $this->createRole($validated);

        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil ditambahkan.');
    }

    private function validateRole(Request $request)
    {
        return $request->validate([
            'nama_role' => 'required|string|max:255',
        ]);
    }

    private function createRole(array $data)
    {
        $data['nama_role'] = $this->formatNamaRole($data['nama_role']);
        Role::create($data);
    }

    private function formatNamaRole($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }

    public function edit($id)
    {
        $item = Role::findOrFail($id);
        return view('admin.role.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateRole($request);
        $item = Role::findOrFail($id);

        $validated['nama_role'] = $this->formatNamaRole($validated['nama_role']);
        $item->update($validated);

        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = Role::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil dihapus.');
    }
}
