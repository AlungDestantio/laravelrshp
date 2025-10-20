<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $data = KategoriKlinis::orderBy('idkategori_klinis')->get();
        return view('admin.kategoriklinis.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kategori_klinis' => 'required|string|max:255']);
        KategoriKlinis::create($request->only('nama_kategori_klinis'));
        return redirect()->route('admin.kategori-klinis.index')->with('success','Kategori klinis ditambahkan.');
    }

    public function edit($id)
    {
        $item = KategoriKlinis::findOrFail($id);
        return view('admin.kategoriklinis.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_kategori_klinis' => 'required|string|max:255']);
        $item = KategoriKlinis::findOrFail($id);
        $item->update($request->only('nama_kategori_klinis'));
        return redirect()->route('admin.kategori-klinis.index')->with('success','Kategori klinis diperbarui.');
    }

    public function destroy($id)
    {
        KategoriKlinis::findOrFail($id)->delete();
        return redirect()->route('admin.kategori-klinis.index')->with('success','Kategori klinis dihapus.');
    }
}
