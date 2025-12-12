@extends('layouts.admin')

@section('title', 'Tambah Jenis Hewan')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Tambah Jenis Hewan</h1>
        <p>Tambah data jenis hewan untuk kebutuhan layanan klinik.</p>
    </div>
</div>

<div class="container">

    {{-- ALERT VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger text-start">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-5">
        <div class="card-body">
            <form action="{{ route('admin.jenis-hewan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_jenis_hewan" class="form-label fw-semibold">Nama Jenis Hewan</label>
                    <input type="text" name="nama_jenis_hewan" id="nama_jenis_hewan" class="form-control @error('nama_jenis_hewan') is-invalid @enderror" placeholder="Masukkan nama jenis hewan" value="{{ old('nama_jenis_hewan') }}" required>
                    @error('nama_jenis_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add px-4 me-2">
                        <i class="bi bi-plus-circle me-1"></i> Simpan
                    </button>
                    <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
