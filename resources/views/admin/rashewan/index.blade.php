@extends('layouts.admin')
@section('title','Ras Hewan')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Daftar Ras Hewan</h1>
        <p>Kelola data ras hewan dengan mudah dan efisien.</p>
    </div>
</div>

<div class="alert-container">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif
</div>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3" style="max-width:1100px;margin:auto;">
        <a href="{{ route('admin.ras-hewan.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle"></i> Tambah Ras Hewan
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>NO</th>
                        <th>Jenis Hewan</th>
                        <th>Nama Ras</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $grouped = $data->groupBy('idjenis_hewan');
                    $no = 1;
                @endphp

                @foreach($grouped as $jenisId => $items)
                    {{-- Baris utama: Jenis Hewan --}}
                    <tr style="background:#f5f7ff; font-weight:bold;">
                        <td>{{ $no++ }}</td>
                        <td>{{ $items->first()->jenis->nama_jenis_hewan }}</td>
                        <td></td>
                        <td></td>
                    </tr>

                    {{-- Daftar Ras di bawahnya --}}
                    @foreach($items as $i)
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $i->nama_ras }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.ras-hewan.edit', $i->idras_hewan) }}" class="action-btn btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.ras-hewan.destroy', $i->idras_hewan) }}" method="POST" onsubmit="return confirm('Hapus ras ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endforeach

                @if($data->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center py-3 text-muted">Belum ada data ras hewan.</td>
                    </tr>
                @endif
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
