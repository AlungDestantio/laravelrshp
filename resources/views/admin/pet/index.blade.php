@extends('layouts.admin')
@section('title','Pet')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Daftar Pet</h1>
        <p>Kelola data hewan peliharaan dengan mudah dan efisien.</p>
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
        <a href="{{ route('admin.pet.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle"></i> Tambah Pet
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>NO</th>
                        <th>Nama</th>
                        <th>Pemilik</th>
                        <th>Tgl Lahir</th>
                        <th>Jenis</th>
                        <th>Ras</th>
                        <th>Warna/Tanda</th>
                        <th>JK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->nama }}</td>
                        <td>{{ $d->pemilik->user->nama ?? '-' }}</td>
                        <td>{{ $d->tanggal_lahir }}</td>
                        <td>{{ $d->ras->jenis->nama_jenis_hewan }}</td>
                        <td>{{ $d->ras->nama_ras ?? '-' }}</td>
                        <td>{{ $d->warna_tanda }}</td>
                        <td>{{ $d->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}</td>
                        
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
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada data pet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
