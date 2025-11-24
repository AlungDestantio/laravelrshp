@extends('layouts.resepsionis')

@section('title', 'Registrasi Pemilik')

@section('content')
<div class="container mt-5">

    {{-- ALERT SUCCESS & ERROR --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    {{-- ============================ --}}
    {{-- FORM REGISTRASI --}}
    {{-- ============================ --}}
    <h2 class="fw-bold mb-4 text-center">Registrasi Pemilik Hewan</h2>

    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-body p-4">

            <form action="{{ route('resepsionis.registrasi-pemilik.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Pemilik</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="contoh@mail.com" required>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nomor WhatsApp</label>
                        <input type="text" name="no_wa" class="form-control" placeholder="08xxxxxxxxxx" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat lengkap" required>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4 me-2">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>


    {{-- ============================ --}}
    {{-- TABEL PEMILIK --}}
    {{-- ============================ --}}
    <h3 class="fw-bold mb-3 text-center">Daftar Pemilik Terdaftar</h3>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped align-middle">
                    <thead class="table-primary">
                        <tr class="text-center">
                            <th style="width:70px;">ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No WA</th>
                            <th>Alamat</th>
                            <th style="width:180px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $p)
                        <tr>
                            <td class="text-center fw-bold">{{ $p->idpemilik }}</td>
                            <td>{{ $p->user->nama }}</td>
                            <td>{{ $p->user->email }}</td>
                            <td>{{ $p->no_wa }}</td>
                            <td>{{ $p->alamat }}</td>

                            <td class="text-center">
                                <a href="{{ route('resepsionis.registrasi-pemilik.edit', $p->idpemilik) }}"
                                   class="btn btn-sm btn-warning px-3 me-2">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>

                                <form action="{{ route('resepsionis.registrasi-pemilik.destroy', $p->idpemilik) }}"
                                      method="POST"
                                      style="display:inline-block;"
                                      onsubmit="return confirm('Yakin ingin menghapus pemilik ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger px-3">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                Belum ada data pemilik terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
@endsection
