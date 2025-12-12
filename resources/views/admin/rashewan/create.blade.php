@extends('layouts.admin')

@section('title', 'Tambah Ras Hewan')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- ================= HEADER ================= --}}
<div class="page-header">
    <div class="container">
        <h1>Tambah Ras Hewan</h1>
        <p>Tambahkan data ras hewan sesuai jenisnya.</p>
    </div>
</div>

<div class="container">

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

    <div class="card mb-5">
        <div class="card-body">
            <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
                @csrf

                {{-- NAMA RAS --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Ras</label>
                    <input type="text" name="nama_ras" class="form-control" value="{{ old('nama_ras') }}" required>
                </div>

                {{-- JENIS HEWAN --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Hewan</label>
                    <select name="idjenis_hewan" class="form-select" required>
                        <option value="">-- Pilih Jenis Hewan --</option>
                        @foreach($jenis as $j)
                            <option value="{{ $j->idjenis_hewan }}" {{ old('idjenis_hewan') == $j->idjenis_hewan ? 'selected' : '' }}>
                                {{ $j->nama_jenis_hewan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add px-4 ms-2">
                        <i class="bi bi-plus-circle me-1"></i> Simpan
                    </button>
                    <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection