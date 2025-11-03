@extends('layouts.admin')

@section('title', 'Jenis Hewan')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<!-- HEADER -->
<div class="page-header">
    <div class="container">
        <h1>Daftar Jenis Hewan</h1>
        <p>Kelola data jenis hewan yang tersedia di sistem RSH Pendidikan UNAIR</p>
    </div>
</div>

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3" style="max-width:1100px;margin:auto;">
    <h4 class="fw-bold mb-0">Daftar Jenis Hewan</h4>
    {{-- Tombol menuju halaman create --}}
    <a href="{{ route('admin.jenis-hewan.create') }}" class="btn btn-add">
        <i class="bi bi-plus-circle"></i> Tambah Jenis Hewan
    </a>
  </div>

  {{-- Alert sukses --}}
  @if(session('success'))
  <div class="alert alert-success text-center">{{ session('success') }}</div>
  @endif

  {{-- Tabel Data --}}
  <div class="card">
    <div class="table-responsive">
      <table class="table align-middle">
        <thead class="table-light">
          <tr>
            <th style="width: 10%">ID</th>
            <th style="width: 70%">Nama Jenis Hewan</th>
            <th style="width: 20%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($data as $d)
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
          @empty
          <tr>
            <td colspan="3" class="text-center text-muted py-4">
              Belum ada data jenis hewan.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
