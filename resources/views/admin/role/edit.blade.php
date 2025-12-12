@extends('layouts.admin')

@section('title', 'Edit Role')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Edit Role</h1>
        <p>Perbarui nama role pengguna dalam sistem.</p>
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

            <form action="{{ route('admin.role.update', $item->idrole) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Role</label>
                    <input type="text"
                           name="nama_role"
                           class="form-control @error('nama_role') is-invalid @enderror"
                           value="{{ old('nama_role', $item->nama_role) }}"
                           required>
                    @error('nama_role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add text-white px-4 me-2">
                        <i class="bi bi-save me-1"></i> Perbarui
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
