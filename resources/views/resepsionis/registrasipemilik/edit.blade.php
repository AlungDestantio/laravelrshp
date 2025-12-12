@extends('layouts.resepsionis')

@section('title', 'Edit Pemilik')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- ============ HEADER ============ --}}
<div class="page-header">
    <div class="container">
        <h1>Edit Pemilik</h1>
        <p>Ubah data pemilik hewan yang terdaftar.</p>
    </div>
</div>

<div class="container">

    {{-- ============ FORM EDIT ============ --}}
    <div class="card">
        <form action="{{ route('resepsionis.registrasi-pemilik.update', $data->idpemilik) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama</label>
                    <input type="text" name="nama" class="form-control"
                           value="{{ $data->user->nama }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ $data->user->email }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nomor WA</label>
                    <input type="text" name="no_wa" class="form-control"
                           value="{{ $data->no_wa }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Alamat</label>
                    <input type="text" name="alamat" class="form-control"
                           value="{{ $data->alamat }}" required>
                </div>
            </div>

            <div class="text-end mt-4">
                <button class="btn btn-add px-4 me-2" style="min-width:130px;">
                    <i class="bi bi-save me-1"></i> Update
                </button>

                <a href="{{ route('resepsionis.registrasi-pemilik.index') }}"
                   class="btn btn-secondary px-4"
                   style="border-radius:8px; font-weight:600;">
                    <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                </a>
            </div>

        </form>
    </div>

</div>

@endsection
