@extends('layouts.admin')

@section('title', 'Kategori')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<!-- HEADER -->
<div class="page-header">
    <div class="container">
        <h1>Data Kategori</h1>
        <p>Kelola daftar kategori dengan mudah dan efisien.</p>
    </div>
</div>

<div class="container">
    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-3" style="max-width:1100px;margin:auto;">
        <h4 class="fw-bold mb-0">Daftar Kategori</h4>
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalAdd">
            <i class="bi bi-plus-circle"></i> Tambah Kategori
        </button>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- KONTEN CARD -->
    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th style="width: 10%">ID</th>
                        <th style="width: 70%">Nama Kategori</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{ $d->idkategori }}</td>
                        <td>{{ $d->nama_kategori }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.kategori.edit', $d->idkategori) }}" class="action-btn btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.kategori.destroy', $d->idkategori) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.kategori.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" placeholder="Masukkan nama kategori" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-add" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
