@extends('layouts.app')

@section('title','Dashboard Admin')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold"><i class="bi bi-speedometer2 text-primary"></i> Dashboard Admin</h2>
            <p class="text-muted">Selamat datang, {{ Auth::user()->nama }}.</p>
        </div>
    </div>

    <div class="row g-3">
        @php
            $menus = [
                ['icon'=>'bi-heart','title'=>'Daftar Jenis Hewan','route'=>'admin.jenis-hewan.index'],
                ['icon'=>'bi-diagram-3','title'=>'Daftar Ras Hewan','route'=>'admin.ras-hewan.index'],
                ['icon'=>'bi-tags','title'=>'Daftar Kategori','route'=>'admin.kategori.index'],
                ['icon'=>'bi-file-medical','title'=>'Daftar Kategori Klinis','route'=>'admin.kategori-klinis.index'],
                ['icon'=>'bi-clipboard2-pulse','title'=>'Daftar Kode Tindakan Terapi','route'=>'admin.kode-tindakan.index'],
                ['icon'=>'bi-heart','title'=>'Daftar Pet','route'=>'admin.pet.index'],
                ['icon'=>'bi-shield-check','title'=>'Daftar Role','route'=>'admin.role.index'],
                ['icon'=>'bi-people','title'=>'Daftar User & Role','route'=>'admin.user.index'],
            ];
        @endphp

        @foreach($menus as $m)
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center p-3">
                <div class="card-body">
                    <i class="{{ $m['icon'] }} fs-1 text-primary mb-2"></i>
                    <h5 class="fw-bold">{{ $m['title'] }}</h5>
                    <a href="{{ route($m['route']) }}" class="btn btn-primary mt-3">Lihat Data</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
