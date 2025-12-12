@extends('layouts.admin')
@section('title','Edit Role User')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== PAGE HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Edit Role User</h1>
        <p>Perbarui role untuk pengguna {{ $user->nama }}.</p>
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
            <form action="{{ route('admin.manajemen_role.update', $user->iduser) }}" method="POST">
                @csrf
                @method('PUT')

                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Role</th>
                            <th>Miliki Role</th>
                            <th>Role Aktif</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->nama_role }}</td>
                            <td>
                                <input type="checkbox" name="roles[]" value="{{ $role->idrole }}"
                                    {{ in_array($role->idrole, $userRoles) ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input type="radio" name="active_role" value="{{ $role->idrole }}"
                                    {{ $activeRoleId == $role->idrole ? 'checked' : '' }}>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add text-white px-4 me-2">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>

                    <a href="{{ route('admin.manajemen_role.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
