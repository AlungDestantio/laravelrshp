@extends('layouts.admin')
@section('title','Data Perawat')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Daftar Perawat</h1>
        <p>Kelola data perawat klinik.</p>
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
        <a href="{{ route('admin.perawat.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle"></i> Tambah Perawat
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>NO</th>
                        <th>Nama</th>
                        <th>Pendidikan</th>
                        <th>No HP</th>
                        <th>JK</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->user->nama ?? '-' }}</td>
                        <td>{{ $d->pendidikan }}</td>
                        <td>{{ $d->no_hp }}</td>
                        <td>{{ $d->jenis_kelamin }}</td>
                        <td>{{ $d->alamat }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.perawat.edit', $d->id_perawat) }}" class="action-btn btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.perawat.destroy', $d->id_perawat) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                        <td colspan="6" class="text-center text-muted py-4">Belum ada data perawat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
