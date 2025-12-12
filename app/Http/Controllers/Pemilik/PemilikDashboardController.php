<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;


class PemilikDashboardController extends Controller
{
    public function index()
    {   
        return view('pemilik.dashboard');
    }

    public function profile()
    {

        $user = Auth::user();

        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        return view('pemilik.profile', compact('user', 'pemilik'));
    }
}
