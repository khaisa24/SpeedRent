@extends('layouts.app')

@section('title', 'Manajemen Kategori - SpeedRent')

@section('content')
<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="text-white mb-1">Manajemen Kategori</h2>
                        <p class="text-muted mb-0">Kelola kategori kendaraan di SpeedRent</p>
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
            <!-- Form Input Kategori -->
            <div class="col-lg-4 mb-4">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-plus-circle me-2 text-orange"></i>
                            {{ isset($editKategori) ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
                        </h5>
                        
                        <form action="{{ isset($editKategori) ? route('admin.kategori.update', $editKategori->id_kategori) : route('admin.kategori.store') }}" method="POST">
                            @csrf
                            @if(isset($editKategori))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" 
                                       value="{{ old('nama_kategori', $editKategori->nama_kategori ?? '') }}" 
                                       required placeholder="Contoh: SUV, Sedan, Motor">
                                @error('nama_kategori')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="jenis" class="form-label">Jenis Kendaraan</label>
                                <select class="form-control" id="jenis" name="jenis" required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="Mobil" {{ old('jenis', $editKategori->jenis ?? '') == 'Mobil' ? 'selected' : '' }}>Mobil</option>
                                    <option value="Motor" {{ old('jenis', $editKategori->jenis ?? '') == 'Motor' ? 'selected' : '' }}>Motor</option>
                                    <option value="Lainnya" {{ old('jenis', $editKategori->jenis ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('jenis')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-orange-primary">
                                    <i class="fas fa-save me-2"></i>
                                    {{ isset($editKategori) ? 'Update Kategori' : 'Simpan Kategori' }}
                                </button>
                                
                                @if(isset($editKategori))
                                    <a href="{{ route('admin.kategori') }}" class="btn btn-orange-outline">
                                        <i class="fas fa-times me-2"></i>Batal Edit
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Daftar Kategori -->
            <div class="col-lg-8">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-list me-2 text-orange"></i>
                            Daftar Kategori
                        </h5>

                        @if($kategoris->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th>Nama Kategori</th>
                                            <th>Jenis</th>
                                            <th>Tanggal Dibuat</th>
                                            <th width="120" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kategoris as $index => $kategori)
                                            <tr>
                                                <td class="text-muted">{{ $index + 1 }}</td>
                                                <td class="text-white">{{ $kategori->nama_kategori }}</td>
                                                <td>
                                                    <span class="badge 
                                                        {{ $kategori->jenis == 'Mobil' ? 'bg-primary' : 
                                                           ($kategori->jenis == 'Motor' ? 'bg-success' : 'bg-warning') }}">
                                                        {{ $kategori->jenis }}
                                                    </span>
                                                </td>
                                                <td class="text-muted">
                                                    {{ $kategori->created_at->format('d/m/Y') }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('admin.kategori', ['edit' => $kategori->id_kategori]) }}" 
                                                           class="btn btn-orange-outline" 
                                                           data-bs-toggle="tooltip" 
                                                           title="Edit Kategori">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.kategori.destroy', $kategori->id_kategori) }}" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="btn btn-orange-outline" 
                                                                    data-bs-toggle="tooltip" 
                                                                    title="Hapus Kategori">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada kategori</h5>
                                <p class="text-muted">Mulai dengan menambahkan kategori pertama Anda</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Additional Styles for Kategori Page */
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto scroll to form when editing
        @if(isset($editKategori))
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