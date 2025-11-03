<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\RasHewan;
use App\Models\Pemilik;

class PetController extends Controller
{
    public function index()
    {
        $data = Pet::with(['ras.jenis', 'pemilik.user'])
                    ->orderBy('idpet')
                    ->get();

        return view('admin.pet.index', compact('data'));
    }

    public function create()
    {
        $ras = RasHewan::all();
        $pemilik = Pemilik::with('user')->get();

        return view('admin.pet.create', compact('ras', 'pemilik'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePet($request);
        $this->createPet($validated);

        return redirect()->route('admin.pet.index')
                         ->with('success', 'Data pet berhasil ditambahkan.');
    }

    private function validatePet(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|string|in:M,F',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
        ]);
    }

    private function createPet(array $data)
    {
        $data['nama'] = $this->formatNamaPet($data['nama']);
        Pet::create($data);
    }

    private function formatNamaPet($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }

    public function edit($id)
    {
        $item = Pet::findOrFail($id);
        $ras = RasHewan::all();
        $pemilik = Pemilik::with('user')->get();

        return view('admin.pet.edit', compact('item', 'ras', 'pemilik'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validatePet($request);
        $item = Pet::findOrFail($id);

        $validated['nama'] = $this->formatNamaPet($validated['nama']);
        $item->update($validated);

        return redirect()->route('admin.pet.index')
                         ->with('success', 'Data pet berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = Pet::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.pet.index')
                         ->with('success', 'Data pet berhasil dihapus.');
    }
}
