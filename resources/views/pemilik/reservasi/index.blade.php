@extends('layouts.pemilik')

@section('title', 'Reservasi Saya')

@section('content')
<div class="container mt-5">
    <h2 class="text-warning fw-bold mb-4 text-center">Reservasi Saya</h2>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-warning">
                    <tr>
                        <th>No Urut</th>
                        <th>Waktu Reservasi</th>
                        <th>Nama Hewan</th>
                        <th>Nama Dokter</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservasi as $r)
                        <tr>
                            <td>{{ $r->no_urut }}</td>
                            <td>{{ $r->waktu_daftar }}</td>
                            <td>{{ $r->pet->nama }}</td>
                            <td>{{ $r->dokter->user->nama ?? '-' }}</td>
                            <td>{{ ucfirst($r->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
