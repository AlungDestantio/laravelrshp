@extends('layouts.resepsionis')

@section('title', 'Registrasi Pet')

@section('content')
<div class="container mt-5">
    <h2 class="text-success fw-bold mb-4 text-center">Registrasi Hewan Peliharaan</h2>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('resepsionis.registrasi-pet.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="idpemilik" class="form-label fw-semibold">Pilih Pemilik</label>
                        <select name="idpemilik" id="idpemilik" class="form-select" required>
                            <option value="">-- Pilih Pemilik --</option>
                            @foreach ($pemilik as $p)
                                <option value="{{ $p->idpemilik }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nama" class="form-label fw-semibold">Nama Hewan</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama hewan" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                            <option value="J">Jantan</option>
                            <option value="B">Betina</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="warna_tanda" class="form-label fw-semibold">Warna / Tanda Khusus</label>
                        <input type="text" id="warna_tanda" name="warna_tanda" class="form-control" placeholder="Contoh: Putih, belang, dll">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="idjenis_hewan" class="form-label fw-semibold">Jenis Hewan</label>
                        <select name="idjenis_hewan" id="idjenis_hewan" class="form-select" required>
                            <option value="">-- Pilih Jenis Hewan --</option>
                            @foreach ($jenis_hewan as $j)
                                <option value="{{ $j->idjenis_hewan }}">{{ $j->nama_jenis_hewan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="idras_hewan" class="form-label fw-semibold">Ras Hewan</label>
                        <select name="idras_hewan" id="idras_hewan" class="form-select" required>
                            <option value="">-- Pilih Ras Hewan --</option>
                            @foreach ($ras_hewan as $r)
                                <option value="{{ $r->idras_hewan }}">{{ $r->nama_ras }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                    <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary px-4">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
