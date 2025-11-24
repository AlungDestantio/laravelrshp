@extends('layouts.resepsionis')

@section('title', 'Edit Pemilik')

@section('content')
<div class="container mt-5" style="max-width: 900px;">

    <h2 class="text-primary fw-bold mb-4 text-center">Edit Pemilik</h2>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('resepsionis.registrasi-pemilik.update', $data->idpemilik) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $data->user->nama }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $data->user->email }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nomor WA</label>
                        <input type="text" name="no_wa" class="form-control" value="{{ $data->no_wa }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="{{ $data->alamat }}" required>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button class="btn btn-primary px-4 me-2">
                        <i class="fas fa-save me-2"></i>Update
                    </button>

                    <a href="{{ route('resepsionis.registrasi-pemilik.index') }}" class="btn btn-secondary px-4">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
