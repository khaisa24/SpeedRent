

<?php $__env->startSection('title', 'Laporan - SpeedRent'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="text-white mb-1">Laporan & Analitik</h2>
                        <p class="text-muted mb-0">Dashboard lengkap untuk analisis bisnis SpeedRent</p>
                    </div>
                    
                    <!-- Filter Periode -->
                    <div class="d-flex gap-3 align-items-center">
                        <form method="GET" class="d-flex gap-2">
                            <select name="periode" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="hari_ini" <?php echo e($periode == 'hari_ini' ? 'selected' : ''); ?>>Hari Ini</option>
                                <option value="minggu_ini" <?php echo e($periode == 'minggu_ini' ? 'selected' : ''); ?>>Minggu Ini</option>
                                <option value="bulan_ini" <?php echo e($periode == 'bulan_ini' ? 'selected' : ''); ?>>Bulan Ini</option>
                                <option value="tahun_ini" <?php echo e($periode == 'tahun_ini' ? 'selected' : ''); ?>>Tahun Ini</option>
                                <option value="semua" <?php echo e($periode == 'semua' ? 'selected' : ''); ?>>Semua Waktu</option>
                            </select>
                            <button type="submit" class="btn btn-orange-outline btn-sm">
                                <i class="fas fa-filter"></i>
                            </button>
                        </form>
                        <button class="btn btn-orange-primary btn-sm">
                            <i class="fas fa-download me-1"></i>Export
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Periode - Dipindahkan ke atas -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="orange-card">
                    <div class="card-body py-3">
                        <div class="row text-center">
                            <div class="col-md-3 border-end">
                                <div class="text-success fw-bold fs-4">Rp <?php echo e(number_format($total_pendapatan, 0, ',', '.')); ?></div>
                                <small class="text-muted">Total Pendapatan</small>
                                <div class="mt-1">
                                    <small class="text-muted">Periode: <?php echo e(ucfirst(str_replace('_', ' ', $periode))); ?></small>
                                </div>
                            </div>
                            <div class="col-md-3 border-end">
                                <div class="text-primary fw-bold fs-4"><?php echo e($total_transaksi); ?></div>
                                <small class="text-muted">Total Transaksi</small>
                            </div>
                            <div class="col-md-3 border-end">
                                <div class="text-warning fw-bold fs-4">Rp <?php echo e(number_format($rata_rata_sewa, 0, ',', '.')); ?></div>
                                <small class="text-muted">Rata-rata per Rental</small>
                            </div>
                            <div class="col-md-3">
                                <div class="text-info fw-bold fs-4"><?php echo e($kendaraan_terpopuler->count()); ?></div>
                                <small class="text-muted">Kendaraan Aktif</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Kendaraan Terpopuler -->
            <div class="col-lg-6 mb-4">
                <div class="orange-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-3">
                            <i class="fas fa-crown me-2 text-warning"></i>
                            Kendaraan Terpopuler
                        </h5>
                        
                        <?php if($kendaraan_terpopuler->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>Kendaraan</th>
                                            <th class="text-center">Sewa</th>
                                            <th class="text-center">Rank</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $kendaraan_terpopuler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $populer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <div class="text-white small"><?php echo e($populer->kendaraan->merk); ?> <?php echo e($populer->kendaraan->model); ?></div>
                                                    <small class="text-muted"><?php echo e($populer->kendaraan->plat_nomor); ?></small>
                                                </td>
                                                <td class="text-center text-white"><?php echo e($populer->total_sewa); ?>x</td>
                                                <td class="text-center">
                                                    <?php if($index == 0): ?>
                                                        <span class="badge bg-warning">#1</span>
                                                    <?php elseif($index == 1): ?>
                                                        <span class="badge bg-secondary">#2</span>
                                                    <?php elseif($index == 2): ?>
                                                        <span class="badge bg-danger">#3</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-dark">#<?php echo e($index + 1); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-3">
                                <i class="fas fa-car fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0 small">Belum ada data kendaraan</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Customer Teraktif -->
            <div class="col-lg-6 mb-4">
                <div class="orange-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-3">
                            <i class="fas fa-users me-2 text-info"></i>
                            Customer Teraktif
                        </h5>
                        
                        <?php if($customer_teraktif->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th class="text-center">Rental</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $customer_teraktif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <div class="text-white small"><?php echo e($customer->user->nama_user); ?></div>
                                                    <small class="text-muted"><?php echo e($customer->user->email); ?></small>
                                                </td>
                                                <td class="text-center text-white"><?php echo e($customer->total_rental); ?>x</td>
                                                <td class="text-center">
                                                    <?php if($customer->total_rental >= 10): ?>
                                                        <span class="badge bg-success">VIP</span>
                                                    <?php elseif($customer->total_rental >= 5): ?>
                                                        <span class="badge bg-primary">Regular</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary">New</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-3">
                                <i class="fas fa-users fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0 small">Belum ada data customer</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Metode Pembayaran -->
            <div class="col-lg-6 mb-4">
                <div class="orange-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-3">
                            <i class="fas fa-credit-card me-2 text-success"></i>
                            Metode Pembayaran
                        </h5>
                        
                        <?php if($metode_pembayaran->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>Metode</th>
                                            <th class="text-center">Transaksi</th>
                                            <th class="text-end">Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $metode_pembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <span class="badge bg-info">
                                                        <?php echo e(ucfirst($metode->metode_pembayaran)); ?>

                                                    </span>
                                                </td>
                                                <td class="text-center text-white"><?php echo e($metode->total); ?></td>
                                                <td class="text-end text-success">Rp <?php echo e(number_format($metode->total_pendapatan, 0, ',', '.')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-3">
                                <i class="fas fa-credit-card fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0 small">Belum ada data pembayaran</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Grafik Pendapatan Sederhana -->
            <div class="col-lg-6 mb-4">
                <div class="orange-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-3">
                            <i class="fas fa-chart-bar me-2 text-orange"></i>
                            Tren Pendapatan <?php echo e(date('Y')); ?>

                        </h5>
                        
                        <div class="grafik-sederhana">
                            <?php
                                $max_pendapatan = max($pendapatan_bulanan) ?: 1;
                                $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                            ?>
                            
                            <div class="d-flex align-items-end" style="height: 150px; gap: 6px;">
                                <?php $__currentLoopData = $pendapatan_bulanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pendapatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $tinggi = $pendapatan / $max_pendapatan * 100;
                                        $warna = $pendapatan > 0 ? 'var(--orange)' : 'var(--gray)';
                                    ?>
                                    <div class="d-flex flex-column align-items-center" style="flex: 1;">
                                        <div 
                                            class="grafik-bar rounded-top" 
                                            style="height: <?php echo e($tinggi); ?>px; background: <?php echo e($warna); ?>; width: 25px;"
                                            data-bs-toggle="tooltip" 
                                            title="<?php echo e($bulan[$index]); ?>: Rp <?php echo e(number_format($pendapatan, 0, ',', '.')); ?>"
                                        ></div>
                                        <small class="text-muted mt-1"><?php echo e($bulan[$index]); ?></small>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        
                        <div class="mt-3 text-center">
                            <small class="text-muted">
                                Total <?php echo e(date('Y')); ?>: 
                                <strong class="text-success">Rp <?php echo e(number_format(array_sum($pendapatan_bulanan), 0, ',', '.')); ?></strong>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .stat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }
    
    .grafik-bar {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .grafik-bar:hover {
        opacity: 0.8;
        transform: scale(1.05);
    }
    
    .table-hover tbody tr:hover {
        background: rgba(255, 107, 53, 0.1) !important;
    }
    
    .border-end {
        border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
    }
    
    .orange-card {
        border: 1px solid rgba(255, 107, 53, 0.2);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips untuk grafik
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SpeedRent\resources\views/admin/laporan.blade.php ENDPATH**/ ?>