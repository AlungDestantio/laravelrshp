<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;
use Exception;

class JenisHewanController extends Controller
{

    public function index()
    {
        $data = JenisHewan::orderBy('idjenis_hewan')->get();
        return view('admin.jenishewan.index', compact('data'));
    }

    public function create()
    {
        return view('admin.jenishewan.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateJenisHewan($request);
        $this->createJenisHewan($validated);

        return redirect()
            ->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil ditambahkan.');
    }

    private function validateJenisHewan(Request $request, $id = null)
    {


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


    private function formatNamaJenisHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    public function edit($id)
    {
        $item = JenisHewan::findOrFail($id);
        return view('admin.jenishewan.edit', compact('item'));
    }

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

    public function destroy($id)
    {
        $data = JenisHewan::findOrFail($id);


        $data->deleted_by = auth()->id();
        $data->save();


        $data->delete();

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil dihapus.');
    }
}
