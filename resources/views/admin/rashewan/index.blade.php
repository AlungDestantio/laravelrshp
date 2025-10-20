@extends('layouts.app')
@section('title','Ras Hewan')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Daftar Ras Hewan</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddRas">+ Tambah</button>
  </div>

  @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped datatable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Ras</th>
              <th>Jenis Hewan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $d)
            <tr>
              <td>{{ $d->idras_hewan }}</td>
              <td>{{ $d->nama_ras }}</td>
              <td>{{ $d->jenis->nama_jenis_hewan ?? '-' }}</td>
              <td>
                <a href="{{ route('admin.ras-hewan.edit', $d->idras_hewan) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.ras-hewan.destroy', $d->idras_hewan) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
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
<div class="modal fade" id="modalAddRas" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('admin.ras-hewan.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Tambah Ras Hewan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3"><label>Nama Ras</label><input type="text" name="nama_ras" class="form-control" required></div>
        <div class="mb-3"><label>Jenis Hewan</label>
          <select name="idjenis_hewan" class="form-select" required>
            <option value="">Pilih Jenis</option>
            @foreach($jenis as $j)<option value="{{ $j->idjenis_hewan }}">{{ $j->nama_jenis_hewan }}</option>@endforeach
          </select>
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
