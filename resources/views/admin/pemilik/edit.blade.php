@extends('layouts.admin')
@section('title','Edit Pemilik')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Edit Pemilik</h1>
        <p>Perbarui data pemilik dan informasi terkait.</p>
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
            <form action="{{ route('admin.pemilik.update', $data->idpemilik) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- USER --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">User</label>
                    <select name="iduser" class="form-select @error('iduser') is-invalid @enderror" required>
                        @foreach($users as $u)
                            <option value="{{ $u->iduser }}" {{ $data->iduser == $u->iduser ? 'selected' : '' }}>
                                {{ $u->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('iduser')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NO WA --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">No WA</label>
                    <input type="text"
                        name="no_wa"
                        class="form-control @error('no_wa') is-invalid @enderror"
                        value="{{ old('no_wa', $data->no_wa) }}"
                        required>
                    @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ALAMAT --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea
                        name="alamat"
                        class="form-control @error('alamat') is-invalid @enderror"
                        rows="3"
                        required>{{ old('alamat', $data->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TOMBOL --}}
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add text-white px-4 me-2">
                        <i class="bi bi-save me-1"></i> Perbarui
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
