<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    public function index()
    {
        $data = JenisHewan::orderBy('idjenis_hewan')->get();
        return view('admin.jenishewan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_jenis_hewan' => 'required|string|max:255']);
        JenisHewan::create($request->only('nama_jenis_hewan'));
        return redirect()->route('admin.jenis-hewan.index')->with('success','Jenis hewan ditambahkan.');
    }

    public function edit($id)
    {
        $item = JenisHewan::findOrFail($id);
        return view('admin.jenishewan.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_jenis_hewan' => 'required|string|max:255']);
        $item = JenisHewan::findOrFail($id);
        $item->update($request->only('nama_jenis_hewan'));
        return redirect()->route('admin.jenis-hewan.index')->with('success','Jenis hewan diperbarui.');
    }

    public function destroy($id)
    {
        $item = JenisHewan::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.jenis-hewan.index')->with('success','Jenis hewan dihapus.');
    }
}
