@extends('layouts.owner')

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
            <!-- Daftar Kategori -->
            <div class="col-12">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-list me-2 text-orange"></i>
                            Daftar Kategori Kendaraan
                        </h5>

                        @if($kategoris->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th>Nama Kategori</th>
                                            <th>Jenis</th>
                                            <th>Jumlah Kendaraan</th>
                                            <th>Tanggal Dibuat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kategoris as $index => $kategori)
                                            <tr>
                                                <td class="text-muted">{{ $index + 1 }}</td>
                                                <td class="text-white fw-semibold">{{ $kategori->nama_kategori }}</td>
                                                <td>
                                                    <span class="badge 
                                                        {{ $kategori->jenis == 'Mobil' ? 'bg-primary' : 
                                                           ($kategori->jenis == 'Motor' ? 'bg-success' : 'bg-warning') }}">
                                                        <i class="fas 
                                                            {{ $kategori->jenis == 'Mobil' ? 'fa-car' : 
                                                               ($kategori->jenis == 'Motor' ? 'fa-motorcycle' : 'fa-tags') }} me-1">
                                                        </i>
                                                        {{ $kategori->jenis }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">
                                                        <i class="fas fa-car-side me-1"></i>
                                                        {{ $kategori->kendaraan_count ?? 0 }} Kendaraan
                                                    </span>
                                                </td>
                                                <td class="text-muted">
                                                    {{ $kategori->created_at->format('d/m/Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Summary -->
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="card orange-card stat-card">
                                        <div class="card-body text-center p-3">
                                            <div class="h4 fw-bold text-white mb-1">{{ $kategoris->count() }}</div>
                                            <div class="small text-muted">Total Kategori</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card orange-card stat-card">
                                        <div class="card-body text-center p-3">
                                            <div class="h4 fw-bold text-white mb-1">
                                                {{ $kategoris->where('jenis', 'Mobil')->count() }}
                                            </div>
                                            <div class="small text-muted">Kategori Mobil</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card orange-card stat-card">
                                        <div class="card-body text-center p-3">
                                            <div class="h4 fw-bold text-white mb-1">
                                                {{ $kategoris->where('jenis', 'Motor')->count() }}
                                            </div>
                                            <div class="small text-muted">Kategori Motor</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada kategori</h5>
                                <p class="text-muted">Tidak ada data kategori yang tersedia</p>
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
    
    .card-title {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 1rem;
    }
    
    .stat-card {
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips if any
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection