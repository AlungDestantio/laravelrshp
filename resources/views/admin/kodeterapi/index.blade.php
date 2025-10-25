@extends('layouts.admin')
@section('title','Kode Tindakan Terapi')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<!-- HEADER -->
<div class="page-header">
    <div class="container">
        <h1>Daftar Kode Tindakan Terapi</h1>
        <p>Kelola data kode tindakan terapi dengan mudah dan efisien.</p>
    </div>
</div>

<div class="container">
    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-3" style="max-width:1100px;margin:auto;">
        <h4 class="fw-bold mb-0">Daftar Kode Tindakan Terapi</h4>
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalAdd">
            <i class="bi bi-plus-circle"></i> Tambah Kode Tindakan
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
                        <th style="width: 5%">ID</th>
                        <th style="width: 10%">Kode</th>
                        <th style="width: 35%">Deskripsi</th>
                        <th style="width: 15%">Kategori</th>
                        <th style="width: 15%">Klinis</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.kode-tindakan.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kode Tindakan Terapi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label>Kode</label>
                        <input type="text" name="kode" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Kategori</label>
                        <select name="idkategori" class="form-select" required>
                            <option value="">Pilih</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->idkategori }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label>Kategori Klinis</label>
                        <select name="idkategori_klinis" class="form-select" required>
                            <option value="">Pilih</option>
                            @foreach($kategori_klinis as $kk)
                                <option value="{{ $kk->idkategori_klinis }}">{{ $kk->nama_kategori_klinis }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi_tindakan_terapi" class="form-control" rows="3"></textarea>
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
