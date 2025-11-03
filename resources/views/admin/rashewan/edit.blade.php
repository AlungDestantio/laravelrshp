@extends('layouts.admin')

@section('title', 'Edit Ras Hewan')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="container mt-5" style="max-width:700px;">
    <h2 class="text-center fw-bold mb-4 text-primary">Edit Ras Hewan</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.ras-hewan.update', $item->idras_hewan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Ras</label>
                    <input type="text" name="nama_ras" class="form-control" value="{{ old('nama_ras', $item->nama_ras) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Hewan</label>
                    <select name="idjenis_hewan" class="form-select" required>
                        @foreach($jenis as $j)
                            <option value="{{ $j->idjenis_hewan }}" {{ $j->idjenis_hewan == $item->idjenis_hewan ? 'selected' : '' }}>
                                {{ $j->nama_jenis_hewan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning text-white">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
