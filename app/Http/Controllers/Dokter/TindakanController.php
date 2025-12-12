<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailRekamMedis;

class TindakanController extends Controller
{
    public function store(Request $request, $idrekam)
    {
        $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string',
        ]);

        DetailRekamMedis::create([
            'idrekam_medis' => $idrekam,
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail' => $request->detail
        ]);

        return redirect()->route('dokter.rekam-medis.show', $idrekam)
            ->with('success', 'Tindakan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $detail = DetailRekamMedis::findOrFail($id);
        return view('dokter.rekammedis.edit', compact('detail'));
    }

    public function update(Request $request, $id)
    {
        $detail = DetailRekamMedis::findOrFail($id);
        $detail->update($request->only('idkode_tindakan_terapi','detail'));
        return redirect()->route('dokter.rekam-medis.show', $detail->idrekam_medis)
            ->with('success', 'Tindakan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = DetailRekamMedis::findOrFail($id);
        $data->deleted_by = auth()->id(); 
        $data->save();

        $idrekam = $data->idrekam_medis;

        $data->delete(); 

        return redirect()->route('dokter.rekam-medis.show', $idrekam)
            ->with('success', 'Tindakan berhasil dihapus!');
    }

}
