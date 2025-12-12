@extends('layouts.pemilik')

@section('title', 'Data Hewan Saya')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Data Hewan Saya</h1>
        <p>Informasi lengkap hewan peliharaan yang Anda daftarkan.</p>
    </div>
</div>

<div class="container">

    {{-- =================== CARD TABEL =================== --}}
    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-header fw-bold text-white"
             style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="bi bi-list-ul me-2"></i> Daftar Hewan
        </div>

        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th style="width:60px;">No</th>
                            <th>Nama Pet</th>
                            <th>Tanggal Lahir</th>
                            <th>Warna / Tanda</th>
                            <th>Jenis Kelamin</th>
                            <th>Ras</th>
                            <th>Jenis Hewan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($dataHewan as $hewan)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td>{{ $hewan->nama }}</td>

                            <td>
                                {{ $hewan->tanggal_lahir 
                                    ? date('d M Y', strtotime($hewan->tanggal_lahir)) 
                                    : '-' }}
                            </td>

                            <td>{{ $hewan->warna_tanda ?? '-' }}</td>

                            <td>
                                {{ $hewan->jenis_kelamin === 'J' ? 'Jantan' : 'Betina' }}
                            </td>

                            <td>{{ $hewan->ras->nama_ras ?? '-' }}</td>

                            <td>{{ $hewan->ras->jenis->nama_jenis_hewan ?? '-' }}</td>
                        </tr>
                        @endforeach

                        @if($dataHewan->count() === 0)
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">
                                Anda belum memiliki hewan terdaftar.
                            </td>
                        </tr>
                        @endif

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
