<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\TemuDokter;

class RekamMedisController extends Controller
{

    public function index()
    {
        $rekamMedis = RekamMedis::with('temuDokter.pet', 'dokter.user')->orderBy('idrekam_medis', 'asc')->get();
        return view('admin.rekammedis.index', compact('rekamMedis'));
    }


 
    public function create()
    {
        $reservasi = \App\Models\TemuDokter::with('pet', 'dokter.user')
                    ->whereDate('waktu_daftar', now()->toDateString())
                    ->whereIn('status', ['M','P'])
                    ->get();

        return view('admin.rekammedis.create', compact('reservasi'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'anamnesa' => 'nullable|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'nullable|string',
        ]);

  
        $temu = TemuDokter::findOrFail($request->idreservasi_dokter);

        RekamMedis::create([
            'idreservasi_dokter' => $request->idreservasi_dokter,
            'dokter_pemeriksa' => $temu->idrole_user,
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
            'created_at' => now(),
        ]);

        return redirect()->route('admin.rekam-medis.index')->with('success', 'Rekam medis berhasil ditambahkan!');
    }


    public function show($id)
    {
        $rekamMedis = RekamMedis::with('detailTindakan.kodeTindakanTerapi', 'temuDokter.pet', 'dokter.user')->findOrFail($id);
        return view('admin.rekammedis.detail', compact('rekamMedis'));
    }

    public function edit($id)
    {
        $rekamMedis = RekamMedis::with('temuDokter.pet', 'dokter.user')->findOrFail($id);

        return view('admin.rekammedis.edit', compact('rekamMedis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'anamnesa' => 'nullable|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'nullable|string',
        ]);

        $rekamMedis = RekamMedis::findOrFail($id);

        $rekamMedis->update([
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil diperbarui!');
    }



    public function destroy($id)
    {
        $data = RekamMedis::findOrFail($id);


        $data->deleted_by = auth()->id();
        $data->save();


        $data->delete();

        return redirect()->route('admin.rekam-medis.index')
            ->with('success', 'Data rekam medis berhasil dihapus!');
    }
}
