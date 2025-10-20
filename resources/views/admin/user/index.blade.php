@extends('layouts.app')
@section('title', 'User')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Daftar User</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">+ Tambah</button>
  </div>

  {{-- Alert sukses --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card">
    <div class="card-body">
      <table class="table datatable align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $u)
            <tr>
              <td>{{ $u->iduser }}</td>
              <td>{{ $u->nama }}</td>
              <td>{{ $u->email }}</td>
              <td>
                @if($u->roles->isNotEmpty())
                  @foreach($u->roles as $role)
                    <span class="badge bg-primary">{{ $role->nama_role }}</span>
                  @endforeach
                @else
                  <span class="badge bg-secondary">Belum ada</span>
                @endif
              </td>
              <td>
                <a href="{{ route('admin.user.edit', $u->iduser) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.user.destroy', $u->iduser) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus user ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- Modal Tambah User --}}
<div class="modal fade" id="modalAdd" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('admin.user.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Tambah User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>Nama</label>
          <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Role</label>
          <select name="idrole" class="form-select">
            <option value="">-- Pilih Role --</option>
            @foreach($roles as $r)
              <option value="{{ $r->idrole }}">{{ $r->nama_role }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
