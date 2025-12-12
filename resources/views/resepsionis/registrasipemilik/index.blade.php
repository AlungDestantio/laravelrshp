@extends('layouts.resepsionis')

@section('title', 'Registrasi Pemilik')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- ============ HEADER ============ --}}
<div class="page-header">
    <div class="container">
        <h1>Registrasi Pemilik</h1>
        <p>Tambah dan kelola data pemilik hewan.</p>
    </div>
</div>

<div class="alert-container">
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif
</div>

<div class="container">

    {{-- ================== CARD FORM REGISTRASI ================== --}}
    <div class="card mb-5">

        <div class="card-header fw-bold text-white"
             style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="bi bi-person-plus me-2"></i> Form Registrasi Pemilik Hewan
        </div>

        <div class="card-body">

            <form action="{{ route('resepsionis.registrasi-pemilik.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Pemilik</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="contoh@mail.com" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nomor WhatsApp</label>
                        <input type="text" name="no_wa" class="form-control" placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat lengkap" required>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add">
                        <i class="bi bi-check-circle"></i> Simpan
                    </button>

                    <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>


    {{-- ================== CARD TABEL PEMILIK ================== --}}
    <div class="card mb-5">

        <div class="card-header fw-bold text-white"
             style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="bi bi-people-fill me-2"></i> Daftar Pemilik Terdaftar
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No WA</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $p)
                        <tr>
                            <td data-label="NO">{{ $loop->iteration }}</td>
                            <td data-label="Nama">{{ $p->user->nama }}</td>
                            <td data-label="Email">{{ $p->user->email }}</td>
                            <td data-label="No WA">{{ $p->no_wa }}</td>
                            <td data-label="Alamat">{{ $p->alamat }}</td>

                            <td data-label="Aksi">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('resepsionis.registrasi-pemilik.edit', $p->idpemilik) }}"
                                       class="action-btn btn-edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('resepsionis.registrasi-pemilik.destroy', $p->idpemilik) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus pemilik ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-btn btn-delete">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada data pemilik terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

    </div>

</div>

@endsection
