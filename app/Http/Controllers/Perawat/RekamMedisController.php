<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\TemuDokter;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with('temuDokter.pet')->latest()->get();
        return view('perawat.rekammedis.index', compact('rekamMedis'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
        'anamnesa' => 'nullable|string',
        'temuan_klinis' => 'nullable|string',
        'diagnosa' => 'nullable|string',
    ]);

    $temu = \App\Models\TemuDokter::findOrFail($request->idreservasi_dokter);

    RekamMedis::create([
        'idreservasi_dokter' => $request->idreservasi_dokter,
        'dokter_pemeriksa' => $temu->idrole_user,
        'anamnesa' => $request->anamnesa,
        'temuan_klinis' => $request->temuan_klinis,
        'diagnosa' => $request->diagnosa,
        'created_at' => now(),
    ]);
        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Rekam medis berhasil ditambahkan!');
    }

    public function show($id)
    {
        $rekamMedis = RekamMedis::with('detailTindakan.kodeTindakanTerapi')->findOrFail($id);
        return view('perawat.rekammedis.detail', compact('rekamMedis'));
    }
}
