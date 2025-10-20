@extends('layouts.app')
@section('title','Kode Tindakan Terapi')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Daftar Kode Tindakan Terapi</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">+ Tambah</button>
  </div>

  @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

  <div class="card"><div class="card-body">
    <table class="table datatable">
      <thead><tr><th>ID</th><th>Kode</th><th>Deskripsi</th><th>Kategori</th><th>Klinis</th><th>Aksi</th></tr></thead>
      <tbody>
      @foreach($data as $d)
        <tr>
          <td>{{ $d->idkode_tindakan_terapi }}</td>
          <td>{{ $d->kode }}</td>
          <td>{{ $d->deskripsi_tindakan_terapi }}</td>
          <td>{{ $d->kategori->nama_kategori ?? '-' }}</td>
          <td>{{ $d->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
          <td>
            <a href="{{ route('admin.kode-tindakan.edit', $d->idkode_tindakan_terapi) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('admin.kode-tindakan.destroy', $d->idkode_tindakan_terapi) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
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
  <div class="modal-dialog modal-lg">
    <form action="{{ route('admin.kode-tindakan.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header"><h5 class="modal-title">Tambah Kode Tindakan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-3"><label>Kode</label><input name="kode" class="form-control" required></div>
          <div class="col-md-4"><label>Kategori</label>
            <select name="idkategori" class="form-select" required>
              <option value="">Pilih</option>
              @foreach($kategori as $k)<option value="{{ $k->idkategori }}">{{ $k->nama_kategori }}</option>@endforeach
            </select>
          </div>
          <div class="col-md-5"><label>Kategori Klinis</label>
            <select name="idkategori_klinis" class="form-select" required>
              <option value="">Pilih</option>
              @foreach($kategori_klinis as $kk)<option value="{{ $kk->idkategori_klinis }}">{{ $kk->nama_kategori_klinis }}</option>@endforeach
            </select>
          </div>
        </div>
        <div class="mt-3"><label>Deskripsi</label><textarea name="deskripsi_tindakan_terapi" class="form-control" rows="3"></textarea></div>
      </div>
      <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button class="btn btn-primary">Simpan</button></div>
    </form>
  </div>
</div>
@endsection
