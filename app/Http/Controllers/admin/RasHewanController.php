<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;

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

        return redirect()->route('admin.ras-hewan.index')
                         ->with('success', 'Ras hewan berhasil ditambahkan.');
    }

    private function validateRasHewan(Request $request)
    {
        return $request->validate([
            'nama_ras' => 'required|string|max:255',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan'
        ]);
    }

    private function createRasHewan(array $data)
    {
        $data['nama_ras'] = $this->formatNamaRas($data['nama_ras']);
        RasHewan::create($data);
    }

    private function formatNamaRas($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }

    public function edit($id)
    {
        $item = RasHewan::findOrFail($id);
        $jenis = JenisHewan::all();

        return view('admin.rashewan.edit', compact('item', 'jenis'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateRasHewan($request);
        $item = RasHewan::findOrFail($id);

        $validated['nama_ras'] = $this->formatNamaRas($validated['nama_ras']);
        $item->update($validated);

        return redirect()->route('admin.ras-hewan.index')
                         ->with('success', 'Ras hewan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = RasHewan::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.ras-hewan.index')
                         ->with('success', 'Ras hewan berhasil dihapus.');
    }
}
