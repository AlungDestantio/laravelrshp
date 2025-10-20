<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Models\Pet;
use App\Models\Role;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // counts untuk statistik kecil
        $counts = [
            'users' => User::count(),
            'pets' => Pet::count(),
            'jenis' => JenisHewan::count(),
            'kode' => KodeTindakanTerapi::count(),
        ];

        return view('admin.dashboard', compact('counts'));
    }
}
