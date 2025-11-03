@extends('layouts.admin')

@section('title', 'Edit Jenis Hewan')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="container mt-5" style="max-width:700px;">
    <h2 class="text-center fw-bold mb-4 text-primary">Edit Jenis Hewan</h2>

    {{-- ALERT VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.jenis-hewan.update', $item->idjenis_hewan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_jenis_hewan" class="form-label fw-semibold">Nama Jenis Hewan</label>
                    <input 
                        type="text" 
                        name="nama_jenis_hewan" 
                        id="nama_jenis_hewan" 
                        class="form-control @error('nama_jenis_hewan') is-invalid @enderror"
                        value="{{ old('nama_jenis_hewan', $item->nama_jenis_hewan) }}" 
                        required
                    >
                    @error('nama_jenis_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-warning text-white">
                        <i class="bi bi-save"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
