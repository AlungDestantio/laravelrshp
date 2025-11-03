@extends('layouts.admin')

@section('title', 'Tambah Kode Tindakan Terapi')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="container mt-5" style="max-width:900px;">
    <h2 class="text-center fw-bold mb-4 text-primary">Tambah Kode Tindakan Terapi</h2>

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
            <form action="{{ route('admin.kode-tindakan.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="kode" class="form-label fw-semibold">Kode</label>
                        <input type="text" name="kode" id="kode"
                            class="form-control @error('kode') is-invalid @enderror"
                            value="{{ old('kode') }}" placeholder="T01" required>
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="idkategori" class="form-label fw-semibold">Kategori</label>
                        <select name="idkategori" id="idkategori" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->idkategori }}" {{ old('idkategori') == $k->idkategori ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label for="idkategori_klinis" class="form-label fw-semibold">Kategori Klinis</label>
                        <select name="idkategori_klinis" id="idkategori_klinis" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            @foreach($kategori_klinis as $kk)
                                <option value="{{ $kk->idkategori_klinis }}" {{ old('idkategori_klinis') == $kk->idkategori_klinis ? 'selected' : '' }}>
                                    {{ $kk->nama_kategori_klinis }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-3">
                    <label for="deskripsi_tindakan_terapi" class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi_tindakan_terapi" id="deskripsi_tindakan_terapi" class="form-control" rows="3">{{ old('deskripsi_tindakan_terapi') }}</textarea>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.kode-tindakan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
