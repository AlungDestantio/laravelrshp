@extends('layouts.admin')
@section('title','Kode Tindakan Terapi')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Daftar Kode Tindakan Terapi</h1>
        <p>Kelola data kode tindakan terapi dengan mudah dan efisien.</p>
    </div>
</div>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3" style="max-width:1100px;margin:auto;">
        <h4 class="fw-bold mb-0">Daftar Kode Tindakan Terapi</h4>
        <a href="{{ route('admin.kode-tindakan.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle"></i> Tambah Kode Tindakan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width:5%">ID</th>
                        <th style="width:10%">Kode</th>
                        <th style="width:35%">Deskripsi</th>
                        <th style="width:15%">Kategori</th>
                        <th style="width:15%">Klinis</th>
                        <th style="width:20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $d)
                    <tr>
                        <td>{{ $d->idkode_tindakan_terapi }}</td>
                        <td>{{ $d->kode }}</td>
                        <td>{{ $d->deskripsi_tindakan_terapi }}</td>
                        <td>{{ $d->kategori->nama_kategori ?? '-' }}</td>
                        <td>{{ $d->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.kode-tindakan.edit', $d->idkode_tindakan_terapi) }}" class="action-btn btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.kode-tindakan.destroy', $d->idkode_tindakan_terapi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kode ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada data kode tindakan terapi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
