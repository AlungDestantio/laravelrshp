<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    public function index()
    {

        $roleUserId = auth()->user()
            ->roleUsers()
            ->where('idrole', 2)
            ->value('idrole_user');

        if (!$roleUserId) {
            abort(403, 'Anda tidak memiliki akses sebagai dokter.');
        }

        $rekamMedis = RekamMedis::with([
            
            'temuDokter.pet',
            'dokter.user'
        ])
        ->where('dokter_pemeriksa', $roleUserId)
        ->orderBy('idrekam_medis', 'asc')
        ->get();

        return view('dokter.rekammedis.index', compact('rekamMedis'));
    }

    public function show($id)
    {

        $roleUserId = auth()->user()
            ->roleUsers()
            ->where('idrole', 2)
            ->value('idrole_user');

        if (!$roleUserId) {
            abort(403, 'Anda tidak memiliki akses sebagai dokter.');
        }


        $rekamMedis = RekamMedis::with([
            'temuDokter.pet',
            'dokter.user',
            'detailTindakan.kodeTindakanTerapi'
        ])
        ->where('dokter_pemeriksa', $roleUserId) 
        ->findOrFail($id);

        return view('dokter.rekammedis.detail', compact('rekamMedis'));
    }
}
