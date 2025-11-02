@extends('layouts.resepsionis')

@section('title', 'Temu Dokter')

@section('content')
<div class="container mt-5">
    <h2 class="text-warning fw-bold mb-4 text-center">Pendaftaran Temu Dokter</h2>

    {{-- ALERT MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- FORM PENDAFTARAN --}}
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-body p-4">
            <form action="{{ route('resepsionis.temu-dokter.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="idpet" class="form-label fw-semibold">Pilih Hewan</label>
                        <select name="idpet" id="idpet" class="form-select" required>
                            <option value="">-- Pilih Hewan & Pemilik --</option>
                            @foreach ($pet as $p)
                                <option value="{{ $p->idpet }}">
                                    {{ $p->nama }} — {{ $p->pemilik->user->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="dokter" class="form-label fw-semibold">Pilih Dokter Pemeriksa</label>
                        <select name="idrole_user" id="dokter" class="form-select" required>
                            <option value="">-- Pilih Dokter --</option>
                            @foreach ($dokter as $d)
                                <option value="{{ $d->idrole_user }}">{{ $d->user->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-warning text-white px-4">
                        <i class="fas fa-calendar-plus me-2"></i>Daftarkan
                    </button>
                    <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary px-4">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- TABEL ANTREAN HARI INI --}}
    <div class="card shadow border-0 rounded-4 mb-5">
        <div class="card-header text-white fw-bold" style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="fas fa-list me-2"></i>Daftar Antrean Hari Ini
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
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
                                <form action="{{ route('resepsionis.temu-dokter.updateStatus', $a->idreservasi_dokter) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <select name="status" class="form-select form-select-sm w-auto text-center fw-semibold" required>
                                            <option value="M" {{ $a->status == 'M' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="P" {{ $a->status == 'P' ? 'selected' : '' }}>Proses</option>
                                            <option value="S" {{ $a->status == 'S' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-warning text-white fw-semibold px-3">
                                            <i class="fas fa-sync-alt me-1"></i>Ubah
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada antrean hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- TABEL RIWAYAT TEMU DOKTER --}}
    <div class="card shadow border-0 rounded-4">
        <div class="card-header text-white fw-bold" style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-gold));">
            <i class="fas fa-clock-rotate-left me-2"></i>Riwayat Temu Dokter
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
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
                            <td colspan="6" class="text-center text-muted">Belum ada riwayat temu dokter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
