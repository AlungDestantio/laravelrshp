<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailRekamMedis;

class TindakanController extends Controller
{

    public function store(Request $request, $idrekam)
    {
        $validated = $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string',
        ]);

        $validated['idrekam_medis'] = $idrekam;
        $validated['detail'] = trim($validated['detail'] ?? '');

        DetailRekamMedis::create($validated);

        return redirect()->route('admin.rekam-medis.show', $idrekam)
            ->with('success', 'Tindakan berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $detail = DetailRekamMedis::findOrFail($id);
        return view('admin.rekammedis.editdetail', compact('detail'));
    }


    public function update(Request $request, $id)
    {
        $detail = DetailRekamMedis::findOrFail($id);

        $validated = $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string',
        ]);

        $validated['detail'] = trim($validated['detail'] ?? '');

        $detail->update($validated);

        return redirect()->route('admin.rekam-medis.show', $detail->idrekam_medis)
            ->with('success', 'Tindakan berhasil diupdate!');
    }


    public function destroy($id)
    {
        $data = DetailRekamMedis::findOrFail($id);

        
        $data->deleted_by = auth()->id();
        $data->save();

        $idrekam = $data->idrekam_medis;

        
        $data->delete();

        return redirect()->route('admin.rekam-medis.show', $idrekam)
            ->with('success', 'Tindakan berhasil dihapus!');
    }
}
