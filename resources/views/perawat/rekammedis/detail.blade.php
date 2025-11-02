@extends('layouts.perawat')

@section('title','Detail Rekam Medis')

@section('content')
<div class="container mt-5">
    <h2 class="text-warning fw-bold mb-4 text-center">Detail Rekam Medis - {{ $rekamMedis->temuDokter->pet->nama }}</h2>

    {{-- Rekam Medis Info --}}
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Anamnesa:</strong> {{ $rekamMedis->anamnesa }}</p>
            <p><strong>Temuan Klinis:</strong> {{ $rekamMedis->temuan_klinis }}</p>
            <p><strong>Diagnosa:</strong> {{ $rekamMedis->diagnosa }}</p>
        </div>
    </div>

    {{-- Form Tambah Tindakan --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('perawat.rekam-medis.tindakan.store', $rekamMedis->idrekam_medis) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Tindakan/Terapi</label>
                    <select name="idkode_tindakan_terapi" class="form-select" required>
                        @foreach(\App\Models\KodeTindakanTerapi::all() as $kt)
                            <option value="{{ $kt->idkode_tindakan_terapi }}">{{ $kt->deskripsi_tindakan_terapi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Detail</label>
                    <textarea name="detail" class="form-control"></textarea>
                </div>
                <button class="btn btn-warning">Tambah Tindakan</button>
            </form>
        </div>
    </div>

    {{-- Tabel Daftar Tindakan --}}
    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Daftar Tindakan</h5>
            <table class="table table-bordered table-striped">
                <thead class="table-warning">
                    <tr>
                        <th>No</th>
                        <th>Tindakan/Terapi</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekamMedis->detailTindakan as $dt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dt->kodeTindakanTerapi->deskripsi_tindakan_terapi }}</td>
                            <td>{{ $dt->detail }}</td>
                            <td>
                                <a href="{{ route('perawat.rekam-medis.tindakan.edit', $dt->iddetail_rekam_medis) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('perawat.rekam-medis.tindakan.destroy', $dt->iddetail_rekam_medis) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
