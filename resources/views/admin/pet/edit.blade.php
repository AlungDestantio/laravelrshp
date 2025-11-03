@extends('layouts.admin')

@section('title', 'Edit Pet')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="container mt-5" style="max-width:800px;">
    <h2 class="text-center fw-bold mb-4 text-primary">Edit Data Pet</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.pet.update', $item->idpet) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $item->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pemilik</label>
                    <select name="idpemilik" class="form-select" required>
                        @foreach($pemilik as $p)
                            <option value="{{ $p->idpemilik }}" {{ $p->idpemilik == $item->idpemilik ? 'selected' : '' }}>
                                {{ $p->user->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $item->tanggal_lahir) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Warna / Tanda</label>
                        <input type="text" name="warna_tanda" class="form-control" value="{{ old('warna_tanda', $item->warna_tanda) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select">
                            <option value="">-</option>
                            <option value="J" {{ $item->jenis_kelamin == 'M' ? 'selected' : '' }}>Jantan (J)</option>
                            <option value="B" {{ $item->jenis_kelamin == 'F' ? 'selected' : '' }}>Betina (B)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Ras</label>
                        <select name="idras_hewan" class="form-select" required>
                            @foreach($ras as $r)
                                <option value="{{ $r->idras_hewan }}" {{ $r->idras_hewan == $item->idras_hewan ? 'selected' : '' }}>
                                    {{ $r->nama_ras }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning text-white">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
