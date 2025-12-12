@extends('layouts.admin')

@section('title', 'Tambah Role')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Tambah Role</h1>
        <p>Tambahkan role baru untuk digunakan dalam sistem.</p>
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

            <form action="{{ route('admin.role.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_role" class="form-label fw-semibold">Nama Role</label>
                    <input type="text"
                           id="nama_role"
                           name="nama_role"
                           class="form-control @error('nama_role') is-invalid @enderror"
                           value="{{ old('nama_role') }}"
                           placeholder="Contoh: Admin, Dokter, Resepsionis"
                           required>
                    @error('nama_role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add px-4 me-2">
                        <i class="bi bi-plus-circle me-1"></i> Simpan
                    </button>

                    <a href="{{ route('admin.role.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
