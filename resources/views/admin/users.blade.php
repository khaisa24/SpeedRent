@extends('layouts.app')

@section('title', 'Manajemen User - SpeedRent')

@section('content')
<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="text-white mb-1">Manajemen User</h2>
                        <p class="text-muted mb-0">Kelola pengguna sistem SpeedRent</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                @foreach($errors->all() as $error)
                    <div class="small">{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- Form Input User -->
            <div class="col-lg-4 mb-4">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-plus-circle me-2 text-orange"></i>
                            {{ isset($editUser) ? 'Edit User' : 'Tambah User Baru' }}
                        </h5>
                        
                        <form action="{{ isset($editUser) ? route('admin.users.update', $editUser->id_user) : route('admin.users.store') }}" method="POST">
                            @csrf
                            @if(isset($editUser))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="nama_user" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_user" name="nama_user" 
                                       value="{{ old('nama_user', $editUser->nama_user ?? '') }}" 
                                       required placeholder="Nama lengkap user">
                                @error('nama_user')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ old('email', $editUser->email ?? '') }}" 
                                       required placeholder="email@contoh.com">
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    Password 
                                    @if(isset($editUser))
                                        <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small>
                                    @endif
                                </label>
                                <input type="password" class="form-control" id="password" name="password" 
                                       {{ isset($editUser) ? '' : 'required' }}
                                       placeholder="{{ isset($editUser) ? 'Password baru...' : 'Minimal 8 karakter' }}">
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="user" {{ old('role', $editUser->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role', $editUser->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-orange-primary">
                                    <i class="fas fa-save me-2"></i>
                                    {{ isset($editUser) ? 'Update User' : 'Simpan User' }}
                                </button>
                                
                                @if(isset($editUser))
                                    <a href="{{ route('admin.users') }}" class="btn btn-orange-outline">
                                        <i class="fas fa-times me-2"></i>Batal Edit
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Daftar Users -->
            <div class="col-lg-8">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-list me-2 text-orange"></i>
                            Daftar Pengguna
                        </h5>

                        @if($users->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th>User</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Bergabung</th>
                                            <th width="120" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $index => $user)
                                            <tr>
                                                <td class="text-muted">{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="text-white">{{ $user->nama_user }}</div>
                                                    @if($user->id_user == auth()->id())
                                                        <small class="text-orange">(Anda)</small>
                                                    @endif
                                                </td>
                                                <td class="text-muted">{{ $user->email }}</td>
                                                <td>
                                                    @if($user->role == 'admin')
                                                        <span class="badge bg-danger">Admin</span>
                                                    @else
                                                        <span class="badge bg-primary">User</span>
                                                    @endif
                                                </td>
                                                <td class="text-muted">
                                                    {{ $user->created_at->format('d/m/Y') }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('admin.users', ['edit' => $user->id_user]) }}" 
                                                           class="btn btn-orange-outline" 
                                                           data-bs-toggle="tooltip" 
                                                           title="Edit User">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        
                                                        @if($user->id_user != auth()->id())
                                                            <form action="{{ route('admin.users.destroy', $user->id_user) }}" 
                                                                  method="POST" 
                                                                  class="d-inline"
                                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->nama_user }}?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="btn btn-orange-outline" 
                                                                        data-bs-toggle="tooltip" 
                                                                        title="Hapus User">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-orange-outline" disabled
                                                                    data-bs-toggle="tooltip" 
                                                                    title="Tidak dapat menghapus akun sendiri">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Statistik -->
                            <div class="mt-4 pt-3 border-top">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="text-primary fw-bold fs-5">{{ $users->where('role', 'admin')->count() }}</div>
                                        <small class="text-muted">Admin</small>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-success fw-bold fs-5">{{ $users->where('role', 'user')->count() }}</div>
                                        <small class="text-muted">User</small>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-warning fw-bold fs-5">{{ $users->count() }}</div>
                                        <small class="text-muted">Total</small>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada data user</h5>
                                <p class="text-muted">Mulai dengan menambahkan user pertama</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background: rgba(255, 107, 53, 0.1) !important;
    }
    
    .btn-group-sm > .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    
    .card-title {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 1rem;
    }
    
    .border-top {
        border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto scroll to form when editing
        @if(isset($editUser))
            document.querySelector('.orange-card').scrollIntoView({
                behavior: 'smooth'
            });
        @endif

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection