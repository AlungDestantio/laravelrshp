@extends('layouts.dokter')

@section('title', 'Edit Tindakan')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Edit Tindakan</h1>
        <p>Perbarui data tindakan pada rekam medis.</p>
    </div>
</div>

<div class="container">

    {{-- ALERT VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger text-start">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-5">
        <div class="card-body">

            <form action="{{ route('dokter.tindakan.update', $detail->iddetail_rekam_medis) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- TINDAKAN --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tindakan</label>
                    <select name="idkode_tindakan_terapi" class="form-select @error('idkode_tindakan_terapi') is-invalid @enderror" required>
                        @foreach(\App\Models\KodeTindakanTerapi::all() as $kt)
                            <option value="{{ $kt->idkode_tindakan_terapi }}"
                                {{ $detail->idkode_tindakan_terapi == $kt->idkode_tindakan_terapi ? 'selected' : '' }}>
                                {{ $kt->deskripsi_tindakan_terapi }}
                            </option>
                        @endforeach
                    </select>
                    @error('idkode_tindakan_terapi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DETAIL --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Detail</label>
                    <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" rows="3">{{ old('detail', $detail->detail) }}</textarea>
                    @error('detail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTONS --}}
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add text-white px-4 me-2">
                        <i class="bi bi-save me-1"></i> Perbarui
                    </button>

                    <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection