@extends('layouts.admin')
@section('title','Tambah Perawat')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="container mt-4" style="max-width:900px;">
    <h3 class="fw-bold mb-3">Tambah Perawat</h3>

    <div class="card p-4">
        <form action="{{ route('admin.perawat.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">User</label>
                <select name="iduser" class="form-select" required>
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $u)
                    <option value="{{ $u->iduser }}">{{ $u->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Pendidikan</label>
                <input type="text" name="pendidikan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3"></textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.perawat.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
