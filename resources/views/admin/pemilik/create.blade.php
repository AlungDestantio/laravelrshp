@extends('layouts.admin')

@section('title','Tambah Pemilik')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Tambah Pemilik</h1>
        <p>Tambahkan data pemilik berdasarkan user yang tersedia.</p>
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

            <form action="{{ route('admin.pemilik.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">User</label>
                    <select name="iduser" class="form-select @error('iduser') is-invalid @enderror" required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $u)
                            <option value="{{ $u->iduser }}" {{ old('iduser') == $u->iduser ? 'selected' : '' }}>
                                {{ $u->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('iduser')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">No WA</label>
                    <input type="text"
                           name="no_wa"
                           class="form-control @error('no_wa') is-invalid @enderror"
                           value="{{ old('no_wa') }}"
                           placeholder="Contoh: 089512345678"
                           required>
                    @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat"
                              class="form-control @error('alamat') is-invalid @enderror"
                              rows="3"
                              placeholder="Masukkan alamat lengkap"
                              required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add px-4 me-2">
                        <i class="bi bi-plus-circle me-1"></i> Simpan
                    </button>

                    <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
