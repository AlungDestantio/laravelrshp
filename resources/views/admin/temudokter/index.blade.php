@extends('layouts.admin')

@section('title', 'Temu Dokter')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- ================= HEADER ================= --}}
<div class="page-header">
    <div class="container">
        <h1>Temu Dokter</h1>
        <p>Daftarkan hewan untuk pemeriksaan dokter dan kelola antrean hari ini.</p>
    </div>
</div>

<div class="alert-container">
    {{-- ============ ALERT ============ --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>

<div class="container">

    {{-- ================= FORM PENDAFTARAN ================= --}}
    <div class="card mb-5">
        <div class="card-body">

            <form action="{{ route('admin.temu-dokter.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pilih Hewan</label>
                        <select name="idpet" class="form-select" required>
                            <option value="">-- Pilih Hewan & Pemilik --</option>
                            @foreach ($pet as $p)
                                <option value="{{ $p->idpet }}">
                                    {{ $p->nama }} — {{ $p->pemilik->user->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pilih Dokter Pemeriksa</label>
                        <select name="idrole_user" class="form-select" required>
                            <option value="">-- Pilih Dokter --</option>
                            @foreach ($dokter as $d)
                                <option value="{{ $d->idrole_user }}">{{ $d->user->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-add px-4 me-2">
                        <i class="bi bi-calendar-plus me-1"></i>Daftarkan
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </form>

        </div>
    </div>



    {{-- ================= ANTREAN HARI INI ================= --}}
    <div class="card mb-5">
        <div class="card-header text-white fw-bold"
             style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="bi bi-list-check me-1"></i> Daftar Antrean Hari Ini
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No Urut</th>
                            <th>Nama Hewan</th>
                            <th>Pemilik</th>
                            <th>Dokter</th>
                            <th>Status</th>
                            <th>Waktu Daftar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($antrean as $a)
                        <tr>
                            <td>{{ $a->no_urut }}</td>
                            <td>{{ $a->pet->nama }}</td>
                            <td>{{ $a->pet->pemilik->user->nama }}</td>
                            <td>{{ $a->dokter->user->nama }}</td>
                            <td>
                                @if ($a->status == 'M')
                                    <span class="badge bg-secondary">Menunggu</span>
                                @elseif ($a->status == 'P')
                                    <span class="badge bg-info text-dark">Proses</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td>{{ date('H:i', strtotime($a->waktu_daftar)) }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-2">

                                    {{-- SELECT STATUS --}}
                                    <form action="{{ route('admin.temu-dokter.updateStatus', $a->idreservasi_dokter) }}"
                                            method="POST" class="d-flex align-items-center gap-2">
                                        @csrf
                                        @method('PUT')

                                        <select name="status"
                                                class="form-select form-select-sm fw-semibold text-center"
                                                style="width: 70px;">
                                            <option value="M" {{ $a->status == 'M' ? 'selected' : '' }}>M</option>
                                            <option value="P" {{ $a->status == 'P' ? 'selected' : '' }}>P</option>
                                            <option value="S" {{ $a->status == 'S' ? 'selected' : '' }}>S</option>
                                        </select>

                                        <button type="submit" class="action-btn btn-edit btn-sm px-3">
                                            <i class="bi bi-arrow-repeat me-1"></i>Ubah
                                        </button>
                                    </form>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('admin.temu-dokter.delete', $a->idreservasi_dokter) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus antrean ini?')"
                                            class="d-flex align-items-center">
                                        @csrf
                                        @method('DELETE')

                                        <button class="action-btn btn-delete btn-sm px-3">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-3">Belum ada antrean hari ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    {{-- ================= RIWAYAT ================= --}}
    <div class="card mb-5">
        <div class="card-header text-white fw-bold"
             style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="bi bi-clock-history me-1"></i> Riwayat Temu Dokter
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>No Urut</th>
                            <th>Nama Hewan</th>
                            <th>Pemilik</th>
                            <th>Dokter</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayat as $r)
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($r->waktu_daftar)) }}</td>
                            <td>{{ $r->no_urut }}</td>
                            <td>{{ $r->pet->nama }}</td>
                            <td>{{ $r->pet->pemilik->user->nama }}</td>
                            <td>{{ $r->dokter->user->nama }}</td>
                            <td>
                                @if ($r->status == 'M')
                                    <span class="badge bg-secondary">Menunggu</span>
                                @elseif ($r->status == 'P')
                                    <span class="badge bg-info text-dark">Proses</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Belum ada riwayat temu dokter.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
