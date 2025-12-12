<?php

namespace App\Http\Controllers\Resepsionis;

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

        $pemilik = Pemilik::whereHas('user.roles', function($q){
            $q->where('role.idrole', 5); 
        })->with('user')->get();

        $jenis_hewan = JenisHewan::all();
        $ras_hewan = RasHewan::all();


        $pet = Pet::with(['pemilik.user', 'ras.jenis'])
                  ->orderBy('idpet')
                  ->get();

        return view('resepsionis.registrasipet.index', compact(
            'pemilik',
            'jenis_hewan',
            'ras_hewan',
            'pet'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'idpemilik' => 'required|integer',
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string|max:45',
            'jenis_kelamin' => 'required|string|max:1',
            'idras_hewan' => 'required|integer',
        ]);

        Pet::create($request->only(['idpemilik', 'nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idras_hewan']));

        return redirect()->route('resepsionis.registrasi-pet.index')
                         ->with('success', 'Hewan peliharaan berhasil didaftarkan.');
    }


    public function edit($id)
    {
        $data = Pet::with(['pemilik.user', 'ras.jenis'])->findOrFail($id);

        $pemilik = Pemilik::whereHas('user.roles', function($q){
            $q->where('role.idrole', 5);
        })->with('user')->get();

        $jenis_hewan = JenisHewan::all();
        $ras_hewan = RasHewan::all();

        return view('resepsionis.registrasipet.edit', compact(
            'data',
            'pemilik',
            'jenis_hewan',
            'ras_hewan'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idpemilik' => 'required|integer',
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string|max:45',
            'jenis_kelamin' => 'required|string|max:1',
            'idras_hewan' => 'required|integer',
        ]);

        $pet = Pet::findOrFail($id);
        $pet->update($request->only(['idpemilik', 'nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idras_hewan']));

        return redirect()->route('resepsionis.registrasi-pet.index')
                         ->with('success', 'Data hewan berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $data = Pet::findOrFail($id);
        $data->deleted_by = auth()->id(); 
        $data->save();

        $data->delete(); 

        return redirect()->route('resepsionis.registrasi-pet.index')
            ->with('success', 'Data pet berhasil dihapus!');
    }
}

