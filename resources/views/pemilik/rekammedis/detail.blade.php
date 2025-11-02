@extends('layouts.pemilik')

@section('title','Detail Rekam Medis')

@section('content')
<div class="container mt-5">
    <h2 class="text-warning fw-bold mb-4 text-center">Detail Rekam Medis - {{ $rekamMedis->temuDokter->pet->nama }}</h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Dokter Pemeriksa:</strong> {{ $rekamMedis->dokter->user->nama ?? '-' }}</p>
            <p><strong>Anamnesa:</strong> {{ $rekamMedis->anamnesa }}</p>
            <p><strong>Temuan Klinis:</strong> {{ $rekamMedis->temuan_klinis }}</p>
            <p><strong>Diagnosa:</strong> {{ $rekamMedis->diagnosa }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Daftar Tindakan</h5>
            <table class="table table-bordered table-striped">
                <thead class="table-warning">
                    <tr>
                        <th>No</th>
                        <th>Tindakan/Terapi</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekamMedis->detailTindakan as $dt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dt->kodeTindakanTerapi->deskripsi_tindakan_terapi }}</td>
                            <td>{{ $dt->detail }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
