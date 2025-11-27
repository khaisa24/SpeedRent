

<?php $__env->startSection('title', 'Dashboard - SpeedRent Owner'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <div class="container-fluid py-4">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card orange-card">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="auth-header">
                                    <div class="car-icon mb-2">
                                        <i class="fas fa-crown fa-2x"></i>
                                    </div>
                                    <h4 class="logo-text mb-2">Selamat Datang, Owner <?php echo e(Auth::user()->nama_user); ?>! 👑</h4>
                                    <p class="auth-subtitle mb-0">
                                        Kelola bisnis rental kendaraan dengan mudah
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="date-info small">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    <?php echo e(now()->translatedFormat('l, d F Y')); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <!-- Owner Statistics -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card orange-card stat-card">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small fw-semibold text-muted">Total Kendaraan</div>
                                <div class="h4 fw-bold text-white"><?php echo e($total_kendaraan ?? 0); ?></div>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-car-side fa-2x text-orange"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card orange-card stat-card">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small fw-semibold text-muted">Total Customer</div>
                                <div class="h4 fw-bold text-white"><?php echo e($total_users ?? 0); ?></div>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-users fa-2x text-orange"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card orange-card stat-card">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small fw-semibold text-muted">Kendaraan Tersedia</div>
                                <div class="h4 fw-bold text-white"><?php echo e($available_vehicles_count ?? 0); ?></div>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-key fa-2x text-orange"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card orange-card stat-card">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small fw-semibold text-muted">Pendapatan Bulan Ini</div>
                                <div class="h4 fw-bold text-white">Rp <?php echo e(number_format($pendapatan_bulan_ini ?? 0, 0, ',', '.')); ?></div>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-money-bill-wave fa-2x text-orange"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mb-4">
            <!-- Pie Chart - Status Rental -->
            <div class="col-xl-6 col-lg-6 mb-4">
                <div class="card orange-card">
                    <div class="card-header bg-transparent border-bottom-0 py-3">
                        <h6 class="m-0 fw-bold text-white">Status Rental</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height: 300px;">
                            <canvas id="rentalStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bar Chart - Pendapatan Bulanan -->
            <div class="col-xl-6 col-lg-6 mb-4">
                <div class="card orange-card">
                    <div class="card-header bg-transparent border-bottom-0 py-3">
                        <h6 class="m-0 fw-bold text-white">Pendapatan 6 Bulan Terakhir</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height: 300px;">
                            <canvas id="monthlyIncomeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->  
        <div class="row">
            <!-- Kendaraan Populer Section -->
            <div class="col-12">
                <div class="card orange-card mb-4">
                    <div class="card-header bg-transparent border-bottom-0 py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-white">Kendaraan Populer</h6>
                        <span class="badge bg-orange">
                            <i class="fas fa-fire me-1"></i>Paling Banyak Disewa
                        </span>
                    </div>
                    <div class="card-body">
                        <?php if(isset($popular_vehicles) && $popular_vehicles->count() > 0): ?>
                            <div class="row">
                                <?php $__currentLoopData = $popular_vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card orange-card h-100 popular-vehicle-card">
                                        <div class="card-body text-center position-relative">
                                            <!-- Popular Badge -->
                                            <?php if($loop->iteration <= 3): ?>
                                            <div class="popular-badge position-absolute top-0 start-0 m-2">
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fas fa-crown me-1"></i>#<?php echo e($loop->iteration); ?>

                                                </span>
                                            </div>
                                            <?php endif; ?>

                                            <!-- Rental Count Badge -->
                                            <div class="rental-count position-absolute top-0 end-0 m-2">
                                                <span class="badge bg-orange">
                                                    <i class="fas fa-calendar-check me-1"></i><?php echo e($vehicle->rental_count ?? 0); ?>

                                                </span>
                                            </div>

                                            <?php if($vehicle->foto): ?>
                                                <img src="<?php echo e(asset('storage/' . $vehicle->foto)); ?>"
                                                     alt="<?php echo e($vehicle->nama_kendaraan); ?>"
                                                     class="img-fluid rounded mb-3"
                                                     style="height: 120px; object-fit: cover; width: 100%;">
                                            <?php else: ?>
                                                <div class="bg-dark rounded d-flex align-items-center justify-content-center mb-3"
                                                     style="height: 120px;">
                                                    <i class="fas fa-car fa-3x text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <h6 class="fw-bold text-white mb-2"><?php echo e($vehicle->nama_kendaraan ?? 'N/A'); ?></h6>
                                            
                                            <div class="vehicle-info mb-3">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <small class="text-muted">Plat:</small>
                                                    <small class="text-white"><?php echo e($vehicle->plat_nomor ?? '-'); ?></small>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <small class="text-muted">Total Disewa:</small>
                                                    <span class="badge bg-info"><?php echo e($vehicle->rental_count ?? 0); ?>x</span>
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex justify-content-center">
                                                <span class="badge bg-success">
                                                    <i class="fas fa-car-side me-1"></i><?php echo e($vehicle->status ?? 'Tersedia'); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                        <!-- Fallback jika tidak ada data kendaraan populer -->
                        <div class="row">
                            <?php for($i = 1; $i <= 4; $i++): ?>
                            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                <div class="card orange-card h-100 popular-vehicle-card">
                                    <div class="card-body text-center position-relative">
                                        <!-- Popular Badge -->
                                        <div class="popular-badge position-absolute top-0 start-0 m-2">
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-crown me-1"></i>#<?php echo e($i); ?>

                                            </span>
                                        </div>

                                        <!-- Rental Count Badge -->
                                        <div class="rental-count position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-orange">
                                                <i class="fas fa-calendar-check me-1"></i><?php echo e(rand(15, 45)); ?>

                                            </span>
                                        </div>

                                        <div class="bg-dark rounded d-flex align-items-center justify-content-center mb-3" 
                                             style="height: 120px;">
                                            <i class="fas fa-car fa-3x text-muted"></i>
                                        </div>
                                        
                                        <h6 class="fw-bold text-white mb-2">Kendaraan Populer <?php echo e($i); ?></h6>
                                        
                                        <div class="vehicle-info mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <small class="text-muted">Plat:</small>
                                                <small class="text-white">B 1234 ABC</small>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <small class="text-muted">Total Disewa:</small>
                                                <span class="badge bg-info"><?php echo e(rand(20, 50)); ?>x</span>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <small class="text-muted">Kapasitas:</small>
                                                <small class="text-white"><?php echo e(rand(4, 7)); ?> seat</small>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-center">
                                            <span class="badge bg-success">
                                                <i class="fas fa-car-side me-1"></i>Tersedia
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table-dark {
        background: transparent;
        border-color: rgba(255, 255, 255, 0.1);
    }
    
    .table-dark th,
    .table-dark td {
        border-color: rgba(255, 255, 255, 0.1);
        color: var(--white);
    }
    
    .table-dark thead th {
        background: rgba(255, 255, 255, 0.05);
        color: rgba(255, 255, 255, 0.8);
    }

    .date-info.small {
        color: rgba(255, 255, 255, 0.8);
    }

    .popular-vehicle-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 107, 53, 0.3);
    }

    .popular-vehicle-card:hover {
        transform: translateY(-5px);
        border-color: var(--orange);
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.2);
    }

    .popular-badge .badge {
        font-size: 0.7rem;
        padding: 4px 8px;
    }

    .rental-count .badge {
        font-size: 0.7rem;
        padding: 4px 8px;
    }

    .vehicle-info {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        padding: 10px;
    }

    .bg-orange {
        background-color: var(--orange) !important;
    }
</style>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data untuk grafik (dummy data - nanti bisa diganti dengan data real dari controller)
    const rentalStatusData = {
        labels: ['Selesai', 'Berlangsung', 'Pending'],
        datasets: [{
            data: [<?php echo e($rental_selesai ?? 15); ?>, <?php echo e($rental_aktif ?? 8); ?>, <?php echo e($pending_requests ?? 5); ?>],
            backgroundColor: [
                '#48bb78', // Green for completed
                '#4299e1', // Blue for ongoing
                '#ed8936'  // Orange for pending
            ],
            borderColor: 'rgba(255, 255, 255, 0.1)',
            borderWidth: 2
        }]
    };

    const monthlyIncomeData = {
        labels: ['6 Bulan Lalu', '5 Bulan Lalu', '4 Bulan Lalu', '3 Bulan Lalu', '2 Bulan Lalu', 'Bulan Lalu'],
        datasets: [{
            label: 'Pendapatan (Rp)',
            data: [
                <?php echo e($pendapatan_bulan_ini ? $pendapatan_bulan_ini * 0.7 : 3500000); ?>,
                <?php echo e($pendapatan_bulan_ini ? $pendapatan_bulan_ini * 0.8 : 4000000); ?>,
                <?php echo e($pendapatan_bulan_ini ? $pendapatan_bulan_ini * 0.9 : 4500000); ?>,
                <?php echo e($pendapatan_bulan_ini ? $pendapatan_bulan_ini * 1.1 : 5500000); ?>,
                <?php echo e($pendapatan_bulan_ini ? $pendapatan_bulan_ini * 1.2 : 6000000); ?>,
                <?php echo e($pendapatan_bulan_ini ?? 5000000); ?>

            ],
            backgroundColor: 'rgba(255, 107, 53, 0.8)',
            borderColor: '#FF6B35',
            borderWidth: 2,
            borderRadius: 5
        }]
    };

    // Chart options
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: {
                    color: 'rgba(255, 255, 255, 0.8)',
                    font: {
                        size: 12
                    }
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: 'white',
                bodyColor: 'white',
                borderColor: '#FF6B35',
                borderWidth: 1
            }
        }
    };

    // Pie Chart - Status Rental
    const rentalStatusCtx = document.getElementById('rentalStatusChart').getContext('2d');
    new Chart(rentalStatusCtx, {
        type: 'pie',
        data: rentalStatusData,
        options: {
            ...chartOptions,
            plugins: {
                ...chartOptions.plugins,
                legend: {
                    position: 'bottom',
                    labels: {
                        color: 'rgba(255, 255, 255, 0.8)',
                        font: {
                            size: 11
                        },
                        padding: 20
                    }
                }
            }
        }
    });

    // Bar Chart - Monthly Income
    const monthlyIncomeCtx = document.getElementById('monthlyIncomeChart').getContext('2d');
    new Chart(monthlyIncomeCtx, {
        type: 'bar',
        data: monthlyIncomeData,
        options: {
            ...chartOptions,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.7)',
                        callback: function(value) {
                            return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                },
                x: {
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.7)',
                        maxRotation: 45
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                }
            }
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.owner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SpeedRent\resources\views/owner/dashboard.blade.php ENDPATH**/ ?>