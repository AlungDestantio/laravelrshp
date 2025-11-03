<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;
use Exception;

class KategoriKlinisController extends Controller
{
    // Menampilkan semua data kategori klinis
    public function index()
    {
        $data = KategoriKlinis::orderBy('idkategori_klinis')->get();
        return view('admin.kategoriklinis.index', compact('data'));
    }

    // Halaman form tambah
    public function create()
    {
        return view('admin.kategoriklinis.create');
    }

    // Simpan kategori klinis baru
    public function store(Request $request)
    {
        $validated = $this->validateKategoriKlinis($request);
        $this->createKategoriKlinis($validated);

        return redirect()
            ->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori klinis berhasil ditambahkan.');
    }

    // Validasi input kategori klinis
    private function validateKategoriKlinis(Request $request, $id = null)
    {
        $uniqueRule = $id
            ? 'unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis'
            : 'unique:kategori_klinis,nama_kategori_klinis';

        return $request->validate([
            'nama_kategori_klinis' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule,
            ],
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi.',
            'nama_kategori_klinis.string'   => 'Nama kategori klinis harus berupa teks.',
            'nama_kategori_klinis.max'      => 'Nama kategori klinis maksimal 255 karakter.',
            'nama_kategori_klinis.min'      => 'Nama kategori klinis minimal 3 karakter.',
            'nama_kategori_klinis.unique'   => 'Nama kategori klinis sudah ada.',
        ]);
    }

    // Helper untuk menyimpan data baru
    private function createKategoriKlinis(array $data)
    {
        try {
            KategoriKlinis::create([
                'nama_kategori_klinis' => $this->formatNamaKategoriKlinis($data['nama_kategori_klinis']),
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data kategori klinis: ' . $e->getMessage());
        }
    }

    // Helper untuk format nama menjadi Title Case
    private function formatNamaKategoriKlinis($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    // Halaman edit kategori klinis
    public function edit($id)
    {
        $item = KategoriKlinis::findOrFail($id);
        return view('admin.kategoriklinis.edit', compact('item'));
    }

    // Update data kategori klinis
    public function update(Request $request, $id)
    {
        $validated = $this->validateKategoriKlinis($request, $id);

        $item = KategoriKlinis::findOrFail($id);
        $item->update([
            'nama_kategori_klinis' => $this->formatNamaKategoriKlinis($validated['nama_kategori_klinis']),
        ]);

        return redirect()
            ->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori klinis berhasil diperbarui.');
    }

    // Hapus data kategori klinis
    public function destroy($id)
    {
        $item = KategoriKlinis::findOrFail($id);
        $item->delete();

        return redirect()
            ->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori klinis berhasil dihapus.');
    }
}
