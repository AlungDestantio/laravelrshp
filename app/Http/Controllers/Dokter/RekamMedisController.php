<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    
    public function index()
    {
        $rekamMedis = RekamMedis::with([
            'temuDokter.pet',
            'dokter.user'
        ])->orderBy('idrekam_medis', 'desc')->get();

        return view('dokter.rekammedis.index', compact('rekamMedis'));
    }

    public function show($id)
    {
        $rekamMedis = RekamMedis::with([
            'temuDokter.pet',
            'dokter.user',
            'detailTindakan.kodeTindakanTerapi'
        ])->findOrFail($id);

        return view('dokter.rekammedis.detail', compact('rekamMedis'));
    }
}
