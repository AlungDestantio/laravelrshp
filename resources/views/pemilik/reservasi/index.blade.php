@extends('layouts.pemilik')

@section('title', 'Reservasi Saya')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Reservasi Saya</h1>
        <p>Daftar reservasi pertemuan dokter untuk hewan peliharaan Anda.</p>
    </div>
</div>

<div class="container">

    {{-- =================== CARD TABEL =================== --}}
    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-header fw-bold text-white"
             style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="bi bi-calendar-check me-2"></i> Daftar Reservasi
        </div>

        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 100px;">No Urut</th>
                            <th>Waktu Reservasi</th>
                            <th>Nama Hewan</th>
                            <th>Dokter Pemeriksa</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reservasi as $r)
                        <tr>
                            <td class="fw-bold text-center">{{ $r->no_urut }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($r->waktu_daftar)) }}</td>
                            <td>{{ $r->pet->nama }}</td>
                            <td>{{ $r->dokter->user->nama ?? '-' }}</td>

                            <td>
                                @if ($r->status == 'M')
                                    <span class="badge bg-secondary px-3 py-2">Menunggu</span>
                                @elseif ($r->status == 'P')
                                    <span class="badge bg-info text-dark px-3 py-2">Proses</span>
                                @else
                                    <span class="badge bg-success px-3 py-2">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada data reservasi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    {{-- =============== BUTTON KEMBALI =============== --}}
    <div class="text-center mt-4 mb-5">
        <a href="{{ route('pemilik.dashboard') }}" class="btn btn-secondary px-4">
            <i class="bi bi-arrow-left-circle me-2"></i>Kembali
        </a>
    </div>

</div>

@endsection
