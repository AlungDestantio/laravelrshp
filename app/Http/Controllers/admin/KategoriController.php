<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Exception;

class KategoriController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $data = Kategori::orderBy('idkategori')->get();
        return view('admin.kategori.index', compact('data'));
    }

    // Halaman tambah kategori
    public function create()
    {
        return view('admin.kategori.create');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $validated = $this->validateKategori($request);
        $this->createKategori($validated);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Validasi data input
    private function validateKategori(Request $request, $id = null)
    {
        // Aturan unik untuk update
        $uniqueRule = $id 
            ? 'unique:kategori,nama_kategori,' . $id . ',idkategori'
            : 'unique:kategori,nama_kategori';

        return $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule,
            ],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.string'   => 'Nama kategori harus berupa teks.',
            'nama_kategori.max'      => 'Nama kategori maksimal 255 karakter.',
            'nama_kategori.min'      => 'Nama kategori minimal 3 karakter.',
            'nama_kategori.unique'   => 'Nama kategori sudah ada.',
        ]);
    }

    // Helper untuk menyimpan kategori baru
    private function createKategori(array $data)
    {
        try {
            Kategori::create([
                'nama_kategori' => $this->formatNamaKategori($data['nama_kategori']),
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data kategori: ' . $e->getMessage());
        }
    }

    // Helper untuk memformat nama (Title Case)
    private function formatNamaKategori($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    // Halaman edit kategori
    public function edit($id)
    {
        $item = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('item'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $validated = $this->validateKategori($request, $id);

        $item = Kategori::findOrFail($id);
        $item->update([
            'nama_kategori' => $this->formatNamaKategori($validated['nama_kategori']),
        ]);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $item = Kategori::findOrFail($id);
        $item->delete();

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
