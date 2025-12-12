@extends('layouts.admin')
@section('title','Kategori Klinis')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Daftar Kategori Klinis</h1>
        <p>Kelola data kategori klinis dengan mudah dan efisien.</p>
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
        <a href="{{ route('admin.kategori-klinis.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle"></i> Tambah Kategori Klinis
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 10%">NO</th>
                        <th style="width: 70%">Nama Kategori Klinis</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->nama_kategori_klinis }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.kategori-klinis.edit', $d->idkategori_klinis) }}" class="action-btn btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.kategori-klinis.destroy', $d->idkategori_klinis) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                        <td colspan="3" class="text-center text-muted py-4">
                            Belum ada data kategori klinis.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
