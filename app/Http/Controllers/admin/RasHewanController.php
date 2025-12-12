<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use Exception;

class RasHewanController extends Controller
{

    public function index()
    {
        $data = RasHewan::with('jenis')
                        ->orderBy('idras_hewan')
                        ->get();

        return view('admin.rashewan.index', compact('data'));
    }

    public function create()
    {
        $jenis = JenisHewan::all();
        return view('admin.rashewan.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRasHewan($request);
        $this->createRasHewan($validated);

        return redirect()
            ->route('admin.ras-hewan.index')
            ->with('success', 'Ras hewan berhasil ditambahkan.');
    }


    private function validateRasHewan(Request $request, $id = null)
    {
        $uniqueRule = $id
            ? 'unique:ras_hewan,nama_ras,' . $id . ',idras_hewan'
            : 'unique:ras_hewan,nama_ras';

        return $request->validate([
            'nama_ras' => [
                'required',
                'string',
                'min:3',
                'max:255',
                $uniqueRule,
            ],
            'idjenis_hewan' => [
                'required',
                'exists:jenis_hewan,idjenis_hewan'
            ]
        ], [
            'nama_ras.required' => 'Nama ras wajib diisi.',
            'nama_ras.string'   => 'Nama ras harus berupa teks.',
            'nama_ras.min'      => 'Nama ras minimal 3 karakter.',
            'nama_ras.max'      => 'Nama ras maksimal 255 karakter.',
            'nama_ras.unique'   => 'Nama ras sudah ada.',

            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih.',
            'idjenis_hewan.exists'   => 'Jenis hewan tidak valid.',
        ]);
    }


    private function createRasHewan(array $data)
    {
        try {
            RasHewan::create([
                'nama_ras'       => $this->formatNamaRas($data['nama_ras']),
                'idjenis_hewan'  => $data['idjenis_hewan'],
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data ras hewan: ' . $e->getMessage());
        }
    }

    private function formatNamaRas($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }


    public function edit($id)
    {
        $item = RasHewan::findOrFail($id);
        $jenis = JenisHewan::all();

        return view('admin.rashewan.edit', compact('item', 'jenis'));
    }


    public function update(Request $request, $id)
    {
        $validated = $this->validateRasHewan($request, $id);

        $item = RasHewan::findOrFail($id);

        $item->update([
            'nama_ras'      => $this->formatNamaRas($validated['nama_ras']),
            'idjenis_hewan' => $validated['idjenis_hewan'],
        ]);

        return redirect()
            ->route('admin.ras-hewan.index')
            ->with('success', 'Ras hewan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = RasHewan::findOrFail($id);


        $data->deleted_by = auth()->id();
        $data->save();

        $data->delete();

        return redirect()
            ->route('admin.ras-hewan.index')
            ->with('success', 'Ras hewan berhasil dihapus.');
    }
}
