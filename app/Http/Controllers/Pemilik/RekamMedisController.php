<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    public function index()
    {
        $iduser = auth()->user()->iduser;
        $pemilik = Pemilik::where('iduser', $iduser)->first();
        $rekamMedis = RekamMedis::with(['temuDokter.pet', 'dokter.user'])
            ->whereHas('temuDokter.pet', function($q) use ($pemilik) {
                $q->where('idpemilik', $pemilik->idpemilik);
            })
            ->orderBy('idrekam_medis', 'desc')
            ->get();

        return view('pemilik.rekammedis.index', compact('rekamMedis'));
    }


    public function show($id)
    {
        $rekamMedis = RekamMedis::with(['temuDokter.pet', 'dokter.user', 'detailTindakan.kodeTindakanTerapi'])
            ->findOrFail($id);

        return view('pemilik.rekammedis.detail', compact('rekamMedis'));
    }
}
