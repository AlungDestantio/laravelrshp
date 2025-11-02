<?php

namespace App\Http\Controllers\Perawat;

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

        return redirect()->route('perawat.rekam-medis.show', $idrekam)->with('success', 'Tindakan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $detail = DetailRekamMedis::findOrFail($id);
        return view('perawat.rekam_medis.tindakan_edit', compact('detail'));
    }

    public function update(Request $request, $id)
    {
        $detail = DetailRekamMedis::findOrFail($id);
        $detail->update($request->only('idkode_tindakan_terapi','detail'));
        return redirect()->route('perawat.rekam-medis.show', $detail->idrekam_medis)->with('success', 'Tindakan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $detail = DetailRekamMedis::findOrFail($id);
        $idrekam = $detail->idrekam_medis;
        $detail->delete();
        return redirect()->route('perawat.rekam-medis.show', $idrekam)->with('success', 'Tindakan berhasil dihapus!');
    }
}
