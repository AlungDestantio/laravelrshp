@extends('layouts.admin')

@section('title', 'Edit Kode Tindakan Terapi')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Edit Kode Tindakan Terapi</h1>
        <p>Perbarui informasi kode tindakan terapi beserta kategori dan deskripsinya.</p>
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

            <form action="{{ route('admin.kode-tindakan.update', $item->idkode_tindakan_terapi) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="kode" class="form-label fw-semibold">Kode</label>
                        <input type="text"
                               name="kode"
                               id="kode"
                               class="form-control @error('kode') is-invalid @enderror"
                               value="{{ old('kode', $item->kode) }}"
                               required>
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="idkategori" class="form-label fw-semibold">Kategori</label>
                        <select name="idkategori"
                                id="idkategori"
                                class="form-select @error('idkategori') is-invalid @enderror"
                                required>
                            @foreach($kategori as $k)
                                <option value="{{ $k->idkategori }}"
                                    {{ $k->idkategori == $item->idkategori ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('idkategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-5">
                        <label for="idkategori_klinis" class="form-label fw-semibold">Kategori Klinis</label>
                        <select name="idkategori_klinis"
                                id="idkategori_klinis"
                                class="form-select @error('idkategori_klinis') is-invalid @enderror"
                                required>
                            @foreach($kategori_klinis as $kk)
                                <option value="{{ $kk->idkategori_klinis }}"
                                    {{ $kk->idkategori_klinis == $item->idkategori_klinis ? 'selected' : '' }}>
                                    {{ $kk->nama_kategori_klinis }}
                                </option>
                            @endforeach
                        </select>
                        @error('idkategori_klinis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <label for="deskripsi_tindakan_terapi" class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi_tindakan_terapi"
                              id="deskripsi_tindakan_terapi"
                              class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror"
                              rows="3"
                              placeholder="Masukkan deskripsi tindakan terapi...">{{ old('deskripsi_tindakan_terapi', $item->deskripsi_tindakan_terapi) }}</textarea>
                    @error('deskripsi_tindakan_terapi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add text-white px-4 me-2">
                        <i class="bi bi-save me-1"></i> Perbarui
                    </button>

                    <a href="{{ route('admin.kode-tindakan.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
