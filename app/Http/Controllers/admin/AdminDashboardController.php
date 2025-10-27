<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;
use App\Models\Kategori;
use App\Models\RasHewan;
use App\Models\User;
use App\Models\Role;
use App\Models\Pet;

class AdminDashboardController extends Controller
{
    public function index()
    {   
        return view('admin.dashboard');
    }
}