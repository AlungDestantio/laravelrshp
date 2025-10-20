<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;

class KodeTindakanController extends Controller
{
    public function index()
    {
        $data = KodeTindakanTerapi::with(['kategori','kategoriKlinis'])->orderBy('idkode_tindakan_terapi')->get();
        $kategori = Kategori::all();
        $kategori_klinis = KategoriKlinis::all();
        return view('admin.kodeterapi.index', compact('data','kategori','kategori_klinis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:10',
            'deskripsi_tindakan_terapi' => 'nullable|string',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis'
        ]);
        KodeTindakanTerapi::create($request->only(['kode','deskripsi_tindakan_terapi','idkategori','idkategori_klinis']));
        return redirect()->route('admin.kode-tindakan.index')->with('success','Kode tindakan ditambahkan.');
    }

    public function edit($id)
    {
        $item = KodeTindakanTerapi::findOrFail($id);
        $kategori = Kategori::all();
        $kategori_klinis = KategoriKlinis::all();
        return view('admin.kodeterapi.edit', compact('item','kategori','kategori_klinis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|string|max:10',
            'deskripsi_tindakan_terapi' => 'nullable|string',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis'
        ]);
        $item = KodeTindakanTerapi::findOrFail($id);
        $item->update($request->only(['kode','deskripsi_tindakan_terapi','idkategori','idkategori_klinis']));
        return redirect()->route('admin.kode-tindakan.index')->with('success','Kode tindakan diperbarui.');
    }

    public function destroy($id)
    {
        KodeTindakanTerapi::findOrFail($id)->delete();
        return redirect()->route('admin.kode-tindakan.index')->with('success','Kode tindakan dihapus.');
    }
}
