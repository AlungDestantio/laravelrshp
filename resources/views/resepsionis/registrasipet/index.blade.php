@extends('layouts.resepsionis')

@section('title', 'Registrasi Pet')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- ============ HEADER ============ --}}
<div class="page-header">
    <div class="container">
        <h1>Registrasi Pet</h1>
        <p>Tambah dan kelola data hewan peliharaan.</p>
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

    {{-- ============ CARD FORM REGISTRASI ============ --}}
    <div class="card mb-5">

        <div class="card-header fw-bold text-white"
            style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="bi bi-pencil-square me-2"></i> Form Registrasi Hewan
        </div>

        <div class="card-body">

            <form action="{{ route('resepsionis.registrasi-pet.store') }}" method="POST">
                @csrf

                {{-- PEMILIK & NAMA --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pilih Pemilik</label>
                        <select name="idpemilik" class="form-select" required>
                            <option value="">-- Pilih Pemilik --</option>
                            @foreach ($pemilik as $p)
                                <option value="{{ $p->idpemilik }}">{{ $p->user->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Hewan</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama hewan" required>
                    </div>
                </div>

                {{-- TANGGAL - JK - WARNA --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="J">Jantan</option>
                            <option value="B">Betina</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Warna / Tanda Khusus</label>
                        <input type="text" name="warna_tanda" class="form-control"
                            placeholder="Contoh: Putih, belang, dll">
                    </div>
                </div>

                {{-- JENIS & RAS --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jenis Hewan</label>
                        <select name="idjenis_hewan" id="idjenis_hewan" class="form-select" required>
                            <option value="">-- Pilih Jenis Hewan --</option>
                            @foreach ($jenis_hewan as $j)
                                <option value="{{ $j->idjenis_hewan }}">{{ $j->nama_jenis_hewan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Ras Hewan</label>
                        <select name="idras_hewan" id="idras_hewan" class="form-select" required>
                            <option value="">-- Pilih Ras Hewan --</option>
                            @foreach ($ras_hewan as $r)
                                <option value="{{ $r->idras_hewan }}">{{ $r->nama_ras }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-add px-4">
                        <i class="bi bi-check-circle me-1"></i> Simpan
                    </button>
                    <a href="{{ route('resepsionis.dashboard') }}"
                       class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

    {{-- ============ CARD TABEL PET ============ --}}
    <div class="card mb-5">

        <div class="card-header fw-bold text-white"
             style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="bi bi-list-ul me-2"></i> Daftar Hewan Terdaftar
        </div>

        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Pemilik</th>
                            <th>Jenis</th>
                            <th>Ras</th>
                            <th>Kelamin</th>
                            <th>Warna/Tanda</th>
                            <th style="width:130px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pet as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->pemilik->user->nama }}</td>
                            <td>{{ $p->ras->jenis->nama_jenis_hewan }}</td>
                            <td>{{ $p->ras->nama_ras }}</td>
                            <td>{{ $p->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}</td>
                            <td>{{ $p->warna_tanda }}</td>

                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('resepsionis.registrasi-pet.edit', $p->idpet) }}"
                                       class="action-btn btn-edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('resepsionis.registrasi-pet.delete', $p->idpet) }}"
                                          method="POST" onsubmit="return confirm('Hapus hewan ini?')">
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
                                <td colspan="8" class="text-center text-muted py-4">Belum ada data hewan.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection
