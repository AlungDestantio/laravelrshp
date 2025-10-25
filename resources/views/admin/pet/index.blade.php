@extends('layouts.admin')
@section('title','Pet')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<!-- HEADER -->
<div class="page-header">
    <div class="container">
        <h1>Daftar Pet</h1>
        <p>Kelola data hewan peliharaan dengan mudah dan efisien.</p>
    </div>
</div>

<div class="container">
    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-3" style="max-width:1100px;margin:auto;">
        <h4 class="fw-bold mb-0">Daftar Pet</h4>
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalAdd">
            <i class="bi bi-plus-circle"></i> Tambah Pet
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
                        <th style="width:20%">Nama</th>
                        <th style="width:15%">Tanggal Lahir</th>
                        <th style="width:15%">Warna/Tanda</th>
                        <th style="width:5%">JK</th>
                        <th style="width:20%">Ras</th>
                        <th style="width:20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{ $d->idpet }}</td>
                        <td>{{ $d->nama }}</td>
                        <td>{{ $d->tanggal_lahir }}</td>
                        <td>{{ $d->warna_tanda }}</td>
                        <td>{{ $d->jenis_kelamin }}</td>
                        <td>{{ $d->ras->nama_ras ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.pet.edit', $d->idpet) }}" class="action-btn btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.pet.destroy', $d->idpet) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
        <form action="{{ route('admin.pet.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Warna / Tanda</label>
                    <input type="text" name="warna_tanda" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select">
                        <option value="">-</option>
                        <option value="M">Jantan (M)</option>
                        <option value="F">Betina (F)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Ras</label>
                    <select name="idras_hewan" class="form-select" required>
                        <option value="">Pilih Ras</option>
                        @foreach($ras as $r)
                            <option value="{{ $r->idras_hewan }}">{{ $r->nama_ras }}</option>
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
