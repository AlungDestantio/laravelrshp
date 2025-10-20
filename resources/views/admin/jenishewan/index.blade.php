@extends('layouts.app')

@section('title','Jenis Hewan')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Daftar Jenis Hewan</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddJenis">+ Tambah</button>
  </div>

  @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped datatable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Jenis Hewan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $d)
            <tr>
              <td>{{ $d->idjenis_hewan }}</td>
              <td>{{ $d->nama_jenis_hewan }}</td>
              <td>
                <a href="{{ route('admin.jenis-hewan.edit', $d->idjenis_hewan) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.jenis-hewan.destroy', $d->idjenis_hewan) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
                  @csrf @method('DELETE')
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
</div>

<!-- Modal Add -->
<div class="modal fade" id="modalAddJenis" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('admin.jenis-hewan.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Tambah Jenis Hewan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>Nama Jenis Hewan</label>
          <input type="text" name="nama_jenis_hewan" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
