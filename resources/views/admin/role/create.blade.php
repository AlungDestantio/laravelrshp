@extends('layouts.admin')

@section('title', 'Tambah Role')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="container mt-5" style="max-width:700px;">
    <h2 class="text-center fw-bold mb-4 text-primary">Tambah Role</h2>

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
            <form action="{{ route('admin.role.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Role</label>
                    <input type="text" name="nama_role" class="form-control" value="{{ old('nama_role') }}" required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
