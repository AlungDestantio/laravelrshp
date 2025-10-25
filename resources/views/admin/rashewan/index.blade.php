@extends('layouts.admin')
@section('title','Ras Hewan')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<!-- HEADER -->
<div class="page-header">
    <div class="container">
        <h1>Daftar Ras Hewan</h1>
        <p>Kelola data ras hewan dengan mudah dan efisien.</p>
    </div>
</div>

<div class="container">
    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-3" style="max-width:1100px;margin:auto;">
        <h4 class="fw-bold mb-0">Daftar Ras Hewan</h4>
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalAddRas">
            <i class="bi bi-plus-circle"></i> Tambah Ras Hewan
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
                        <th style="width:5%">ID</th>
                        <th style="width:35%">Nama Ras</th>
                        <th style="width:35%">Jenis Hewan</th>
                        <th style="width:25%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{ $d->idras_hewan }}</td>
                        <td>{{ $d->nama_ras }}</td>
                        <td>{{ $d->jenis->nama_jenis_hewan ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.ras-hewan.edit', $d->idras_hewan) }}" class="action-btn btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.ras-hewan.destroy', $d->idras_hewan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ras ini?')">
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
<div class="modal fade" id="modalAddRas" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.ras-hewan.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Ras Hewan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Ras</label>
                    <input type="text" name="nama_ras" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Jenis Hewan</label>
                    <select name="idjenis_hewan" class="form-select" required>
                        <option value="">Pilih Jenis</option>
                        @foreach($jenis as $j)
                            <option value="{{ $j->idjenis_hewan }}">{{ $j->nama_jenis_hewan }}</option>
                        @endforeach
                    </select>
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
