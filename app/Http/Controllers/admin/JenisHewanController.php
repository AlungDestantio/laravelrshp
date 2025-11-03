<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;
use Exception;

class JenisHewanController extends Controller
{
    // Menampilkan daftar jenis hewan
    public function index()
    {
        $data = JenisHewan::orderBy('idjenis_hewan')->get();
        return view('admin.jenishewan.index', compact('data'));
    }

    // Form tambah jenis hewan
    public function create()
    {
        return view('admin.jenishewan.create');
    }

    // Simpan jenis hewan baru
    public function store(Request $request)
    {
        $validated = $this->validateJenisHewan($request);
        $this->createJenisHewan($validated);

        return redirect()
            ->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil ditambahkan.');
    }

    // Validasi data input
    private function validateJenisHewan(Request $request, $id = null)
    {
        // Jika update, abaikan validasi unik untuk data yang sedang diedit
        $uniqueRule = $id 
            ? 'unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan'
            : 'unique:jenis_hewan,nama_jenis_hewan';

        return $request->validate([
            'nama_jenis_hewan' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule,
            ],
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
            'nama_jenis_hewan.string'   => 'Nama jenis hewan harus berupa teks.',
            'nama_jenis_hewan.max'      => 'Nama jenis hewan maksimal 255 karakter.',
            'nama_jenis_hewan.min'      => 'Nama jenis hewan minimal 3 karakter.',
            'nama_jenis_hewan.unique'   => 'Nama jenis hewan sudah ada.',
        ]);
    }

    // Helper untuk membuat data baru
    private function createJenisHewan(array $data)
    {
        try {
            JenisHewan::create([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data jenis hewan: ' . $e->getMessage());
        }
    }

    // Helper untuk memformat nama menjadi Title Case
    private function formatNamaJenisHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    // Form edit
    public function edit($id)
    {
        $item = JenisHewan::findOrFail($id);
        return view('admin.jenishewan.edit', compact('item'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $validated = $this->validateJenisHewan($request, $id);

        $item = JenisHewan::findOrFail($id);
        $item->update([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan']),
        ]);

        return redirect()
            ->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $item = JenisHewan::findOrFail($id);
        $item->delete();

        return redirect()
            ->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil dihapus.');
    }
}
