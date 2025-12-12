<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\JenisHewan;
use App\Models\RasHewan;

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
        $pemilik = Pemilik::whereHas('user.roles', function($q){
            $q->where('role.idrole', 5); // pastikan prefix tabel
        })->with('user')->get();

        $jenis_hewan = JenisHewan::all();
        $ras_hewan = RasHewan::all();

        return view('admin.pet.create', compact('pemilik', 'jenis_hewan', 'ras_hewan'));
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
            'idpemilik' => 'required|integer',
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string|max:45',
            'jenis_kelamin' => 'required|string|max:1',
            'idras_hewan' => 'required|integer',
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
        $data = Pet::findOrFail($id);
        $jenis_hewan = JenisHewan::all();
        $ras_hewan = RasHewan::all();
        $pemilik = Pemilik::whereHas('user.roles', function($q){
            $q->where('role.idrole', 5);
        })->with('user')->get();

        return view('admin.pet.edit', compact('data','jenis_hewan', 'ras_hewan', 'pemilik'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validatePet($request);
        $data = Pet::findOrFail($id);

        $validated['nama'] = $this->formatNamaPet($validated['nama']);
        $data->update($validated);

        return redirect()->route('admin.pet.index')
                         ->with('success', 'Data pet berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Pet::findOrFail($id);
        $data->deleted_by = auth()->id();
        $data->save();

        $data->delete();

        return redirect()->route('admin.pet.index')
            ->with('success', 'Data pet berhasil dihapus!');
    }
}
