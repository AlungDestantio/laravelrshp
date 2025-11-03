@extends('layouts.admin')

@section('title', 'Edit Role')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="container mt-5" style="max-width:700px;">
    <h2 class="text-center fw-bold mb-4 text-primary">Edit Role</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.role.update', $item->idrole) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Role</label>
                    <input type="text" name="nama_role" class="form-control" value="{{ old('nama_role', $item->nama_role) }}" required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning text-white">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
