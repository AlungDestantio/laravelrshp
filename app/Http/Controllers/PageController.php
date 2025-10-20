<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display home page
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Display layanan page
     */
    public function layanan()
    {
        return view('layanan');
    }

    /**
     * Display kontak page
     */
    public function kontak()
    {
        return view('kontak');
    }

    /**
     * Display struktur organisasi page
     */
    public function strukturOrganisasi()
    {
        return view('struktur-organisasi');
    }

    /**
     * Display login page
     */
    public function login()
    {
        return view('login');
    }
}