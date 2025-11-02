<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index()
    {
    $iduser = Auth::user()->iduser;

    $pemilik = Pemilik::where('iduser', $iduser)->first();

    $dataHewan = Pet::with(['ras.jenis'])
        ->where('idpemilik', $pemilik->idpemilik)
        ->get();

    return view('pemilik.pet.index', compact('dataHewan'));
    }
}
