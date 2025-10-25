@extends('layouts.admin')

@section('title', 'Jenis Hewan')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<!-- Header -->
<div class="page-header">
    <div class="container">
        <h1>Daftar Jenis Hewan</h1>
        <p>Kelola data jenis hewan yang tersedia di sistem RSH Pendidikan UNAIR</p>
    </div>
</div>

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3" style="max-width:1100px;margin:auto;">
    <h4 class="fw-bold mb-0">Daftar Jenis Hewan</h4>
    <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalAddJenis">
      <i class="bi bi-plus-circle"></i> Tambah Jenis Hewan
    </button>
  </div>

  @if(session('success'))
  <div class="alert alert-success text-center">{{ session('success') }}</div>
  @endif

  <div class="card">
    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th style="width: 10%">ID</th>
            <th style="width: 70%">Nama Jenis Hewan</th>
            <th style="width: 20%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $d)
          <tr>
            <td>{{ $d->idjenis_hewan }}</td>
            <td>{{ $d->nama_jenis_hewan }}</td>
            <td>
              <div class="d-flex gap-2">
                <a href="{{ route('admin.jenis-hewan.edit', $d->idjenis_hewan) }}" 
                   class="action-btn btn-edit">
                   <i class="bi bi-pencil-square"></i> Edit
                </a>
                <form action="{{ route('admin.jenis-hewan.destroy', $d->idjenis_hewan) }}" 
                      method="POST" 
                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
<div class="modal fade" id="modalAddJenis" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.jenis-hewan.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jenis Hewan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Jenis Hewan</label>
                    <input type="text" name="nama_jenis_hewan" class="form-control" placeholder="Masukkan nama jenis hewan" required>
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
