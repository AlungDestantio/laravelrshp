<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use Exception;

class KodeTindakanController extends Controller
{
    // Menampilkan semua data kode tindakan
    public function index()
    {
        $data = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])
            ->orderBy('idkode_tindakan_terapi')
            ->get();

        return view('admin.kodeterapi.index', compact('data'));
    }

    // Halaman form tambah
    public function create()
    {
        $kategori = Kategori::all();
        $kategori_klinis = KategoriKlinis::all();
        return view('admin.kodeterapi.create', compact('kategori', 'kategori_klinis'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $this->validateKodeTindakan($request);
        $this->createKodeTindakan($validated);

        return redirect()
            ->route('admin.kode-tindakan.index')
            ->with('success', 'Kode tindakan berhasil ditambahkan.');
    }

    // Validasi input kode tindakan
    private function validateKodeTindakan(Request $request, $id = null)
    {
        $uniqueRule = $id
            ? 'unique:kode_tindakan_terapi,kode,' . $id . ',idkode_tindakan_terapi'
            : 'unique:kode_tindakan_terapi,kode';

        return $request->validate([
            'kode' => [
                'required',
                'string',
                'max:10',
                'min:2',
                $uniqueRule,
            ],
            'deskripsi_tindakan_terapi' => 'nullable|string|max:255',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ], [
            'kode.required' => 'Kode tindakan wajib diisi.',
            'kode.string' => 'Kode tindakan harus berupa teks.',
            'kode.max' => 'Kode tindakan maksimal 10 karakter.',
            'kode.min' => 'Kode tindakan minimal 2 karakter.',
            'kode.unique' => 'Kode tindakan sudah ada.',
            'deskripsi_tindakan_terapi.string' => 'Deskripsi harus berupa teks.',
            'deskripsi_tindakan_terapi.max' => 'Deskripsi maksimal 255 karakter.',
            'idkategori.required' => 'Kategori wajib dipilih.',
            'idkategori.exists' => 'Kategori tidak valid.',
            'idkategori_klinis.required' => 'Kategori klinis wajib dipilih.',
            'idkategori_klinis.exists' => 'Kategori klinis tidak valid.',
        ]);
    }

    // Helper untuk membuat data baru
    private function createKodeTindakan(array $data)
    {
        try {
            KodeTindakanTerapi::create([
                'kode' => $this->formatKode($data['kode']),
                'deskripsi_tindakan_terapi' => $data['deskripsi_tindakan_terapi'] ?? null,
                'idkategori' => $data['idkategori'],
                'idkategori_klinis' => $data['idkategori_klinis'],
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data kode tindakan: ' . $e->getMessage());
        }
    }

    // Helper untuk format kode (uppercase dan trim)
    private function formatKode($kode)
    {
        return strtoupper(trim($kode));
    }

    // Halaman edit
    public function edit($id)
    {
        $item = KodeTindakanTerapi::findOrFail($id);
        $kategori = Kategori::all();
        $kategori_klinis = KategoriKlinis::all();

        return view('admin.kodeterapi.edit', compact('item', 'kategori', 'kategori_klinis'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $validated = $this->validateKodeTindakan($request, $id);

        $item = KodeTindakanTerapi::findOrFail($id);
        $item->update([
            'kode' => $this->formatKode($validated['kode']),
            'deskripsi_tindakan_terapi' => $validated['deskripsi_tindakan_terapi'] ?? null,
            'idkategori' => $validated['idkategori'],
            'idkategori_klinis' => $validated['idkategori_klinis'],
        ]);

        return redirect()
            ->route('admin.kode-tindakan.index')
            ->with('success', 'Kode tindakan berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $item = KodeTindakanTerapi::findOrFail($id);
        $item->delete();

        return redirect()
            ->route('admin.kode-tindakan.index')
            ->with('success', 'Kode tindakan berhasil dihapus.');
    }
}
