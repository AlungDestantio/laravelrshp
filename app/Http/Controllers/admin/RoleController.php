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

    public function store(Request $request)
    {
        $request->validate(['nama_role' => 'required|string|max:255']);
        Role::create($request->only('nama_role'));
        return redirect()->route('admin.role.index')->with('success','Role ditambahkan.');
    }

    public function edit($id)
    {
        $item = Role::findOrFail($id);
        return view('admin.role.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_role' => 'required|string|max:255']);
        $item = Role::findOrFail($id);
        $item->update($request->only('nama_role'));
        return redirect()->route('admin.role.index')->with('success','Role diperbarui.');
    }

    public function destroy($id)
    {
        Role::findOrFail($id)->delete();
        return redirect()->route('admin.role.index')->with('success','Role dihapus.');
    }
}
