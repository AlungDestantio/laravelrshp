@extends('layouts.dokter')

@section('title','Rekam Medis Dokter')

@section('content')
<div class="container mt-5">
    <h2 class="text-warning fw-bold mb-4 text-center">Daftar Rekam Medis</h2>

    {{-- Tabel Rekam Medis --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-warning">
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        <th>Dokter Pemeriksa</th>
                        <th>Anamnesa</th>
                        <th>Temuan Klinis</th>
                        <th>Diagnosa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekamMedis as $rm)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $rm->temuDokter->pet->nama ?? '-' }}</td>
                            <td>{{ $rm->dokter->user->nama ?? '-' }}</td>
                            <td>{{ $rm->anamnesa }}</td>
                            <td>{{ $rm->temuan_klinis }}</td>
                            <td>{{ $rm->diagnosa }}</td>
                            <td>
                                <a href="{{ route('dokter.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-sm btn-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
