<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\Pemilik;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function index()
    {
        $iduser = Auth::user()->iduser;
        $pemilik = Pemilik::where('iduser', $iduser)->first();

        $reservasi = TemuDokter::with(['pet', 'dokter.user'])
            ->whereHas('pet', function($q) use ($pemilik) {
                $q->where('idpemilik', $pemilik->idpemilik);
            })
            ->get();

        return view('pemilik.reservasi.index', compact('reservasi'));
    }
}
