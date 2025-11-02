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
        $pemilik = Pemilik::join('user', 'user.iduser', '=', 'pemilik.iduser')
                    ->select('pemilik.idpemilik', 'user.nama')
                    ->get();

        $jenis_hewan = JenisHewan::all();
        $ras_hewan = RasHewan::all();

        return view('resepsionis.registrasipet.index', compact('pemilik', 'jenis_hewan', 'ras_hewan'));
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

        try {
            Pet::create([
                'idpemilik' => $request->idpemilik,
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'warna_tanda' => $request->warna_tanda,
                'jenis_kelamin' => $request->jenis_kelamin,
                'idras_hewan' => $request->idras_hewan,
            ]);

            return redirect()->route('resepsionis.dashboard')->with('success', 'Hewan peliharaan berhasil didaftarkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}
