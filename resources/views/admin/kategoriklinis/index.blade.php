@extends('layouts.app')
@section('title','Kategori Klinis')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Daftar Kategori Klinis</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">+ Tambah</button>
  </div>

  @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

  <div class="card"><div class="card-body">
    <table class="table datatable">
      <thead><tr><th>ID</th><th>Nama Kategori Klinis</th><th>Aksi</th></tr></thead>
      <tbody>
      @foreach($data as $d)
        <tr>
          <td>{{ $d->idkategori_klinis }}</td>
          <td>{{ $d->nama_kategori_klinis }}</td>
          <td>
            <a href="{{ route('admin.kategori-klinis.edit', $d->idkategori_klinis) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('admin.kategori-klinis.destroy', $d->idkategori_klinis) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div></div>
</div>

<div class="modal fade" id="modalAdd" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('admin.kategori-klinis.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header"><h5 class="modal-title">Tambah Kategori Klinis</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body"><div class="mb-3"><label>Nama</label><input name="nama_kategori_klinis" class="form-control" required></div></div>
      <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button class="btn btn-primary">Simpan</button></div>
    </form>
  </div>
</div>
@endsection
