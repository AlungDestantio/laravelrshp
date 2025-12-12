@extends('layouts.admin')

@section('title', 'Edit User')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Edit User</h1>
        <p>Perbarui informasi user, termasuk role dan status akun.</p>
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
            <form action="{{ route('admin.user.update', $user->iduser) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama</label>
                    <input type="text"
                           name="nama"
                           id="nama"
                           class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $user->nama) }}"
                           required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password (kosongkan jika tidak diubah)</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add text-white px-4 me-2">
                        <i class="bi bi-save me-1"></i> Perbarui
                    </button>

                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
