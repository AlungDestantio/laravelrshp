@extends('layouts.admin')
@section('title','Edit Dokter')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="container mt-4" style="max-width:900px;">
    <h3 class="fw-bold mb-3">Edit Dokter</h3>

    <div class="card p-4">
        <form action="{{ route('admin.dokter.update', $data->id_dokter) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">User</label>
                <select name="id_user" class="form-select" required>
                    @foreach($users as $u)
                    <option value="{{ $u->iduser }}" {{ $data->id_user == $u->iduser ? 'selected' : '' }}>
                        {{ $u->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Bidang Dokter</label>
                <input type="text" name="bidang_dokter" class="form-control" value="{{ $data->bidang_dokter }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ $data->no_hp }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="L" {{ $data->jenis_kelamin=='L'?'selected':'' }}>Laki-laki</option>
                    <option value="P" {{ $data->jenis_kelamin=='P'?'selected':'' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3">{{ $data->alamat }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
