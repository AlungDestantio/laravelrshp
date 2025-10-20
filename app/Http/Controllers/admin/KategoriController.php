<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::orderBy('idkategori')->get();
        return view('admin.kategori.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kategori' => 'required|string|max:255']);
        Kategori::create($request->only('nama_kategori'));
        return redirect()->route('admin.kategori.index')->with('success','Kategori ditambahkan.');
    }

    public function edit($id)
    {
        $item = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_kategori' => 'required|string|max:255']);
        $item = Kategori::findOrFail($id);
        $item->update($request->only('nama_kategori'));
        return redirect()->route('admin.kategori.index')->with('success','Kategori diperbarui.');
    }

    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();
        return redirect()->route('admin.kategori.index')->with('success','Kategori dihapus.');
    }
}
