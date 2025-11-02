@extends('layouts.perawat')

@section('title','Rekam Medis Perawat')

@section('content')
<div class="container mt-5">
    <h2 class="text-warning fw-bold mb-4 text-center">Rekam Medis</h2>

    {{-- Form Tambah Rekam Medis --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('perawat.rekam-medis.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="idreservasi_dokter" class="form-label">Reservasi Dokter</label>
                    <select name="idreservasi_dokter" class="form-select" required>
                        @foreach(\App\Models\TemuDokter::with('pet')->get() as $td)
                            <option value="{{ $td->idreservasi_dokter }}">#{{ $td->no_urut }} - {{ $td->pet->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="dokter_pemeriksa" class="form-label">Dokter Pemeriksa</label>
                    <select name="dokter_pemeriksa" class="form-select" required>
                        @foreach(\App\Models\RoleUser::where('idrole', 2)->with('user')->get() as $dokter)
                            <option value="{{ $dokter->idrole_user }}">{{ $dokter->user->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="anamnesa" class="form-label">Anamnesa</label>
                    <textarea name="anamnesa" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="temuan_klinis" class="form-label">Temuan Klinis</label>
                    <textarea name="temuan_klinis" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="diagnosa" class="form-label">Diagnosa</label>
                    <textarea name="diagnosa" class="form-control"></textarea>
                </div>

                <button class="btn btn-warning">Tambah Rekam Medis</button>
            </form>
        </div>
    </div>

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
                            <td>{{ $rm->temuDokter->pet->nama }}</td>
                            <td>{{ $rm->dokter->user->nama ?? '-' }}</td>
                            <td>{{ $rm->anamnesa }}</td>
                            <td>{{ $rm->temuan_klinis }}</td>
                            <td>{{ $rm->diagnosa }}</td>
                            <td>
                                <a href="{{ route('perawat.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-sm btn-primary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
