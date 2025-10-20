@extends('layouts.app')
@section('title','Pet')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Daftar Pet</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">+ Tambah</button>
  </div>

  @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

  <div class="card"><div class="card-body">
    <table class="table datatable">
      <thead><tr><th>ID</th><th>Nama</th><th>Tanggal Lahir</th><th>Warna/Tanda</th><th>JK</th><th>Ras</th><th>Aksi</th></tr></thead>
      <tbody>
      @foreach($data as $d)
        <tr>
          <td>{{ $d->idpet }}</td>
          <td>{{ $d->nama }}</td>
          <td>{{ $d->tanggal_lahir }}</td>
          <td>{{ $d->warna_tanda }}</td>
          <td>{{ $d->jenis_kelamin }}</td>
          <td>{{ $d->ras->nama_ras ?? '-' }}</td>
          <td>
            <a href="{{ route('admin.pet.edit', $d->idpet) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('admin.pet.destroy', $d->idpet) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
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
    <form action="{{ route('admin.pet.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header"><h5 class="modal-title">Tambah Pet</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="mb-3"><label>Nama</label><input name="nama" class="form-control" required></div>
        <div class="mb-3"><label>Tanggal Lahir</label><input type="date" name="tanggal_lahir" class="form-control"></div>
        <div class="mb-3"><label>Warna / Tanda</label><input name="warna_tanda" class="form-control"></div>
        <div class="mb-3"><label>Jenis Kelamin</label>
          <select name="jenis_kelamin" class="form-select">
            <option value="">-</option><option value="M">Jantan (M)</option><option value="F">Betina (F)</option>
          </select>
        </div>
        <div class="mb-3"><label>Ras</label>
          <select name="idras_hewan" class="form-select" required>
            <option value="">Pilih Ras</option>@foreach($ras as $r)<option value="{{ $r->idras_hewan }}">{{ $r->nama_ras }}</option>@endforeach
          </select>
        </div>
      </div>
      <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button class="btn btn-primary">Simpan</button></div>
    </form>
  </div>
</div>
@endsection
