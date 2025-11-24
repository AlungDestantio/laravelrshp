@extends('layouts.admin')
@section('title','Edit Pemilik')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')
<div class="container mt-4" style="max-width:900px;">
    <h3 class="fw-bold mb-3">Edit Pemilik</h3>

    <div class="card p-4">
        <form action="{{ route('admin.pemilik.update', $data->idpemilik) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">User</label>
                <select name="iduser" class="form-select" required>
                    @foreach($users as $u)
                    <option value="{{ $u->iduser }}" {{ $data->iduser == $u->iduser ? 'selected' : '' }}>
                        {{ $u->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">No WA</label>
                <input type="text" name="no_wa" class="form-control" value="{{ $data->no_wa }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ $data->alamat }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
