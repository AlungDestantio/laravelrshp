<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Perawat;

class PerawatDashboardController extends Controller
{
    public function index()
    {   
        return view('perawat.dashboard');
    }


    public function profile()
    {
        $user = Auth::user();

        $perawat = Perawat::where('iduser', $user->iduser)->first();

        return view('perawat.profile', compact('user', 'perawat'));
    }
}
