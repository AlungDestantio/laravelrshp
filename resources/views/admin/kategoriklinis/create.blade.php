@extends('layouts.admin')

@section('title', 'Tambah Kategori Klinis')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="container mt-5" style="max-width:700px;">
    <h2 class="text-center fw-bold mb-4 text-primary">Tambah Kategori Klinis</h2>

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
            <form action="{{ route('admin.kategori-klinis.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_kategori_klinis" class="form-label fw-semibold">Nama Kategori Klinis</label>
                    <input type="text" name="nama_kategori_klinis" id="nama_kategori_klinis"
                           class="form-control @error('nama_kategori_klinis') is-invalid @enderror"
                           placeholder="Masukkan nama kategori klinis"
                           value="{{ old('nama_kategori_klinis') }}" required>
                    @error('nama_kategori_klinis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
