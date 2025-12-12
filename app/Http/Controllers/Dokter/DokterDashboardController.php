<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokter;

class DokterDashboardController extends Controller
{
    public function index()
    {   
        return view('dokter.dashboard');
    }

    public function profile()
    {
        $user = Auth::user();

        $dokter = Dokter::where('iduser', $user->iduser)->first();

        return view('dokter.profile', compact('user', 'dokter'));
    }
}
