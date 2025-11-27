

<?php $__env->startSection('title', 'Manajemen Kendaraan'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="text-white mb-1">Manajemen Kendaraan</h2>
                        <p class="text-muted mb-0">Kelola semua kendaraan rental di SpeedRent</p>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-orange px-3 py-2">
                            <i class="fas fa-car-side me-1"></i>
                            Total: <?php echo e($kendaraans->count()); ?> Kendaraan
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card orange-card stat-card">
                    <div class="card-body text-center p-3">
                        <div class="stat-number text-success"><?php echo e($kendaraans->where('status', 'Tersedia')->count()); ?></div>
                        <div class="stat-label">
                            <i class="fas fa-check-circle me-1"></i>Tersedia
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card orange-card stat-card">
                    <div class="card-body text-center p-3">
                        <div class="stat-number text-warning"><?php echo e($kendaraans->where('status', 'Disewa')->count()); ?></div>
                        <div class="stat-label">
                            <i class="fas fa-clock me-1"></i>Disewa
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card orange-card stat-card">
                    <div class="card-body text-center p-3">
                        <div class="stat-number text-danger"><?php echo e($kendaraans->where('status', 'Maintenance')->count()); ?></div>
                        <div class="stat-label">
                            <i class="fas fa-tools me-1"></i>Maintenance
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card orange-card stat-card">
                    <div class="card-body text-center p-3">
                        <div class="stat-number text-info"><?php echo e($kendaraans->count()); ?></div>
                        <div class="stat-label">
                            <i class="fas fa-car-side me-1"></i>Total
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Kendaraan -->
        <div class="row">
            <div class="col-12">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-car-side me-2 text-orange"></i>
                            Daftar Semua Kendaraan
                        </h5>
                        
                        <?php if($kendaraans->count() > 0): ?>
                            <div class="row g-4">
                                <?php $__currentLoopData = $kendaraans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kendaraan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                                    <div class="kendaraan-card h-100">
                                        <div class="kendaraan-image">
                                            <img src="<?php echo e($kendaraan->foto ? asset('storage/' . $kendaraan->foto) : 'https://via.placeholder.com/300x200/1a1a1a/FF6B35?text=No+Image'); ?>" 
                                                 alt="<?php echo e($kendaraan->nama_kendaraan); ?>"
                                                 class="kendaraan-img">
                                            <div class="kendaraan-overlay">
                                                <div class="kendaraan-status">
                                                    <?php if($kendaraan->status == 'Tersedia'): ?>
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check me-1"></i>Tersedia
                                                        </span>
                                                    <?php elseif($kendaraan->status == 'Disewa'): ?>
                                                        <span class="badge bg-warning">
                                                            <i class="fas fa-clock me-1"></i>Disewa
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-tools me-1"></i>Maintenance
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="kendaraan-category">
                                                    <span class="badge bg-dark">
                                                        <i class="fas fa-tag me-1"></i><?php echo e($kendaraan->kategori->nama_kategori ?? 'N/A'); ?>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kendaraan-info">
                                            <h6 class="kendaraan-title"><?php echo e($kendaraan->nama_kendaraan); ?></h6>
                                            <div class="kendaraan-meta">
                                                <div class="kendaraan-brand">
                                                    <i class="fas fa-tag me-1 text-muted"></i>
                                                    <?php echo e($kendaraan->merek); ?>

                                                </div>
                                                <div class="kendaraan-plat">
                                                    <i class="fas fa-id-card me-1 text-muted"></i>
                                                    <?php echo e($kendaraan->plat_nomor); ?>

                                                </div>
                                            </div>
                                            <div class="kendaraan-price">
                                                <span class="price-text">
                                                    Rp <?php echo e(number_format($kendaraan->harga->harga_per_hari ?? 0, 0, ',', '.')); ?>/hari
                                                </span>
                                            </div>
                                            <div class="kendaraan-details">
                                                <div class="detail-item">
                                                    <i class="fas fa-users text-muted"></i>
                                                    <span><?php echo e($kendaraan->kapasitas); ?> Seat</span>
                                                </div>
                                                <div class="detail-item">
                                                    <i class="fas fa-gas-pump text-muted"></i>
                                                    <span><?php echo e($kendaraan->bahan_bakar); ?></span>
                                                </div>
                                                <div class="detail-item">
                                                    <i class="fas fa-palette text-muted"></i>
                                                    <span><?php echo e($kendaraan->warna); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="empty-state text-center py-5">
                                <div class="empty-icon mb-3">
                                    <i class="fas fa-car fa-4x text-muted"></i>
                                </div>
                                <h4 class="text-muted mb-2">Belum ada kendaraan</h4>
                                <p class="text-muted">Tidak ada data kendaraan yang tersedia saat ini</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Kendaraan Card Styles */
    .kendaraan-card {
        background: rgba(26, 26, 26, 0.8);
        border: 1px solid rgba(255, 107, 53, 0.2);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
    }

    .kendaraan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(255, 107, 53, 0.25);
        border-color: var(--orange);
    }

    .kendaraan-image {
        height: 200px;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--dark) 0%, var(--black) 100%);
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

    .kendaraan-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.8) 100%);
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .kendaraan-status,
    .kendaraan-category {
        z-index: 2;
    }

    .kendaraan-info {
        padding: 1.25rem;
    }

    .kendaraan-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--white);
        margin-bottom: 0.75rem;
        line-height: 1.3;
    }

    .kendaraan-meta {
        margin-bottom: 1rem;
    }

    .kendaraan-brand,
    .kendaraan-plat {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 0.25rem;
    }

    .kendaraan-price {
        margin-bottom: 1rem;
    }

    .price-text {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--orange);
    }

    .kendaraan-details {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .detail-item i {
        font-size: 0.7rem;
    }

    /* Empty State */
    .empty-state {
        padding: 3rem 2rem;
    }

    .empty-icon {
        margin-bottom: 1.5rem;
    }

    .empty-state h4 {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* Statistics Cards */
    .stat-card {
        transition: all 0.3s ease;
        border: none;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.15);
    }

    .stat-card .card-body {
        padding: 1.5rem 1rem;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.8);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    /* Badge Styles */
    .badge.bg-orange {
        background: linear-gradient(135deg, var(--orange) 0%, var(--orange-light) 100%) !important;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Card Title */
    .card-title {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 1rem;
        font-weight: 600;
        font-size: 1.25rem;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .col-xl-3 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
    }

    @media (max-width: 992px) {
        .col-xl-3 {
            flex: 0 0 50%;
            max-width: 50%;
        }
        
        .kendaraan-image {
            height: 180px;
        }
    }

    @media (max-width: 768px) {
        .col-xl-3 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        .kendaraan-image {
            height: 220px;
        }
        
        .stat-number {
            font-size: 1.75rem;
        }
        
        .kendaraan-details {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .kendaraan-image {
            height: 200px;
        }
        
        .kendaraan-info {
            padding: 1rem;
        }
        
        .kendaraan-title {
            font-size: 1rem;
        }
        
        .price-text {
            font-size: 1rem;
        }
        
        .stat-card .card-body {
            padding: 1.25rem 0.75rem;
        }
        
        .stat-number {
            font-size: 1.5rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth hover effects
        const kendaraanCards = document.querySelectorAll('.kendaraan-card');
        
        kendaraanCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.owner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SpeedRent\resources\views/owner/kendaraan.blade.php ENDPATH**/ ?>