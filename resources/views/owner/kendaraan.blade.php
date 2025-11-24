@extends('layouts.owner')

@section('title', 'Manajemen Kendaraan')

@section('content')
<div class="container py-4">
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Daftar Kendaraan -->
    <div class="row">
        <div class="col-12">
            <div class="orange-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="section-title mb-0">
                        <i class="fas fa-car-side me-2"></i>Daftar Kendaraan
                    </h3>
                    <span class="badge bg-orange px-3 py-2">
                        Total: {{ $kendaraans->count() }} Kendaraan
                    </span>
                </div>
                
                @if($kendaraans->count() > 0)
                    <div class="row g-4">
                        @foreach($kendaraans as $kendaraan)
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                            <div class="kendaraan-card">
                                <div class="kendaraan-image">
                                    <img src="{{ $kendaraan->foto ? asset('storage/' . $kendaraan->foto) : 'https://via.placeholder.com/200x150/1a1a1a/FF6B35?text=No+Image' }}" 
                                         alt="{{ $kendaraan->nama_kendaraan }}"
                                         class="kendaraan-img">
                                    <div class="kendaraan-status">
                                        @if($kendaraan->status == 'Tersedia')
                                            <span class="badge bg-success">Tersedia</span>
                                        @elseif($kendaraan->status == 'Disewa')
                                            <span class="badge bg-warning">Disewa</span>
                                        @else
                                            <span class="badge bg-danger">Maintenance</span>
                                        @endif
                                    </div>
                                    <div class="kendaraan-category">
                                        <span class="badge bg-dark">{{ $kendaraan->kategori->nama_kategori ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="kendaraan-info">
                                    <h6 class="kendaraan-title">{{ Str::limit($kendaraan->nama_kendaraan, 20) }}</h6>
                                    <div class="kendaraan-brand">
                                        <i class="fas fa-tag me-1"></i>{{ Str::limit($kendaraan->merek, 15) }}
                                    </div>
                                    <div class="kendaraan-price">
                                        <small class="text-orange fw-bold">
                                            Rp {{ number_format($kendaraan->harga->harga_per_hari ?? 0, 0, ',', '.') }}/hari
                                        </small>
                                    </div>
                                    <div class="kendaraan-stock">
                                        <small class="text-muted">
                                            <i class="fas fa-layer-group me-1"></i>
                                            Stok: {{ $kendaraan->stok ?? 0 }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Summary Statistics -->
                    <div class="row mt-5">
                        <div class="col-md-3 col-6 mb-3">
                            <div class="stat-card text-center p-3">
                                <div class="stat-number text-orange">{{ $kendaraans->where('status', 'Tersedia')->count() }}</div>
                                <div class="stat-label">Tersedia</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="stat-card text-center p-3">
                                <div class="stat-number text-warning">{{ $kendaraans->where('status', 'Disewa')->count() }}</div>
                                <div class="stat-label">Disewa</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="stat-card text-center p-3">
                                <div class="stat-number text-danger">{{ $kendaraans->where('status', 'Maintenance')->count() }}</div>
                                <div class="stat-label">Maintenance</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="stat-card text-center p-3">
                                <div class="stat-number text-info">{{ $kendaraans->count() }}</div>
                                <div class="stat-label">Total</div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-car fa-3x"></i>
                        <h4>Belum ada kendaraan</h4>
                        <p>Tidak ada data kendaraan yang tersedia</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
    /* Kendaraan Card Styles */
    .kendaraan-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        background: rgba(26, 26, 26, 0.8);
        border: 1px solid rgba(255, 107, 53, 0.2);
        height: 100%;
    }
    
    .kendaraan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(255, 107, 53, 0.3);
        border-color: var(--orange);
    }
    
    .kendaraan-image {
        height: 120px;
        background: linear-gradient(135deg, var(--dark) 0%, var(--black) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    
    .kendaraan-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .kendaraan-card:hover .kendaraan-img {
        transform: scale(1.05);
    }
    
    .kendaraan-status {
        position: absolute;
        top: 8px;
        right: 8px;
        z-index: 2;
    }
    
    .kendaraan-category {
        position: absolute;
        top: 8px;
        left: 8px;
        z-index: 2;
    }
    
    .kendaraan-info {
        padding: 1rem;
    }
    
    .kendaraan-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--white);
        margin-bottom: 0.25rem;
        line-height: 1.2;
    }
    
    .kendaraan-brand {
        color: var(--orange);
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .kendaraan-price {
        margin-bottom: 0.25rem;
    }
    
    .kendaraan-stock {
        margin-bottom: 0;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: rgba(255, 255, 255, 0.6);
    }
    
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: rgba(255, 255, 255, 0.3);
    }
    
    .empty-state h4 {
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }
    
    .empty-state p {
        font-size: 0.9rem;
        margin-bottom: 0;
    }
    
    .section-title {
        color: var(--white);
        font-weight: 700;
        margin-bottom: 0;
        font-size: 1.5rem;
    }
    
    .badge.bg-orange {
        background: linear-gradient(135deg, var(--orange) 0%, var(--orange-light) 100%) !important;
        font-size: 0.8rem;
    }

    /* Stat Cards */
    .stat-card {
        background: rgba(26, 26, 26, 0.8);
        border: 1px solid rgba(255, 107, 53, 0.2);
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.2);
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.7);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .col-xl-2 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
        
        .kendaraan-image {
            height: 100px;
        }
        
        .kendaraan-info {
            padding: 0.75rem;
        }
        
        .kendaraan-title {
            font-size: 0.8rem;
        }
        
        .stat-number {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .col-xl-2 {
            flex: 0 0 50%;
            max-width: 50%;
        }
        
        .kendaraan-image {
            height: 90px;
        }
        
        .section-title {
            font-size: 1.3rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add any additional JavaScript functionality if needed
        console.log('Kendaraan page loaded');
    });
</script>
@endsection