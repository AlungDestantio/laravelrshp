@extends('layouts.admin')
@section('title', 'Manajemen Role')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== PAGE HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Manajemen Role</h1>
        <p>Kelola peran masing-masing user di sistem dengan mudah dan konsisten.</p>
    </div>
</div>

<div class="alert-container">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif
</div>

<div class="container">
    {{-- USER TABLE --}}
    <div class="card mb-5">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width:5%">No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width:15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $i => $user)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $user->nama }}</td>
                        <td><i class="bi bi-envelope me-2"></i>{{ $user->email }}</td>
                        <td>
                            <div class="role-cell">
                                @forelse($user->roles as $role)
                                    <span class="badge-role {{ $role->pivot->status ? 'badge-role-aktif' : 'badge-role-nonaktif' }}">
                                        <span class="role-status-icon"></span>
                                        <span class="{{ !$role->pivot->status ? 'role-text-inactive' : '' }}">
                                            {{ $role->nama_role }}
                                        </span>
                                        @if(!$role->pivot->status)
                                            <small>(Nonaktif)</small>
                                        @endif
                                    </span>
                                @empty
                                    <span class="text-muted">-</span>
                                @endforelse
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.manajemen_role.edit', $user->iduser) }}" class="action-btn btn-edit">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <h4>Belum Ada Data User</h4>
                                <p>Tidak ada user yang terdaftar dalam sistem</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
