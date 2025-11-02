@extends('layouts.pemilik')

@section('title', 'Data Hewan Saya')

@section('content')
<div class="container mt-5">
    <h2 class="text-warning fw-bold mb-4 text-center">Data Hewan Saya</h2>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-warning">
                    <tr>
                        <th>No</th>
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
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $hewan->nama }}</td>
                            <td>{{ $hewan->tanggal_lahir }}</td>
                            <td>{{ $hewan->warna_tanda }}</td>
                            <td>{{ $hewan->jenis_kelamin }}</td>
                            <td>{{ $hewan->ras->nama_ras ?? '-' }}</td>
                            <td>{{ $hewan->ras->jenis->nama_jenis_hewan ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
