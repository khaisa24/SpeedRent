

<?php $__env->startSection('title', 'Manajemen Rental - SpeedRent'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="text-white mb-1">Manajemen Rental</h2>
                        <p class="text-muted mb-0">Kelola penyewaan kendaraan di SpeedRent</p>
                    </div>
                    <div class="badge bg-primary fs-6">
                        <i class="fas fa-sync-alt me-1"></i>
                        <?php echo e($rental_aktif); ?> Rental Aktif
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
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="small"><?php echo e($error); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Daftar Rental -->
        <div class="row">
            <div class="col-12">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-list me-2 text-orange"></i>
                            Daftar Rental
                        </h5>

                        <?php if($rentals->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th>Customer</th>
                                            <th>Kendaraan</th>
                                            <th>Periode Sewa</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                            <th width="120" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $rentals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $rental): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-muted"><?php echo e($index + 1); ?></td>
                                                <td>
                                                    <div class="text-white"><?php echo e($rental->user->nama_user); ?></div>
                                                    <small class="text-muted"><?php echo e($rental->user->email); ?></small>
                                                </td>
                                                <td>
                                                    <div class="text-white"><?php echo e($rental->kendaraan->nama_kendaraan ?? $rental->kendaraan->merk); ?></div>
                                                    <small class="text-muted"><?php echo e($rental->kendaraan->plat_nomor); ?></small>
                                                </td>
                                                <td class="text-muted">
                                                    <div><?php echo e($rental->tanggal_mulai->format('d/m/Y')); ?></div>
                                                    <small>s/d <?php echo e($rental->tanggal_selesai->format('d/m/Y')); ?></small>
                                                    <div class="small text-orange">
                                                        <?php echo e($rental->jumlah_hari); ?> hari
                                                    </div>
                                                </td>
                                                <td class="text-white fw-bold">
                                                    Rp <?php echo e(number_format($rental->total_harga, 0, ',', '.')); ?>

                                                </td>
                                                <td>
                                                    <?php
                                                        $statusClass = [
                                                            'pending' => 'bg-warning',
                                                            'berlangsung' => 'bg-primary', 
                                                            'selesai' => 'bg-success',
                                                            'dibatalkan' => 'bg-danger'
                                                        ][$rental->status_sewa];
                                                    ?>
                                                    <span class="badge <?php echo e($statusClass); ?>">
                                                        <?php echo e(ucfirst($rental->status_sewa)); ?>

                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <!-- Quick Status Update -->
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-orange-outline dropdown-toggle" 
                                                                    data-bs-toggle="dropdown" 
                                                                    title="Ubah Status Rental">
                                                                <i class="fas fa-sync-alt"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <?php $__currentLoopData = ['pending', 'berlangsung', 'selesai', 'dibatalkan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($status != $rental->status_sewa): ?>
                                                                        <li>
                                                                            <form action="<?php echo e(route('admin.rental.updateStatus', $rental->id_rental)); ?>" method="POST" class="d-inline">
                                                                                <?php echo csrf_field(); ?>
                                                                                <?php echo method_field('PUT'); ?>
                                                                                <input type="hidden" name="status_sewa" value="<?php echo e($status); ?>">
                                                                                <button type="submit" class="dropdown-item">
                                                                                    Set <?php echo e(ucfirst($status)); ?>

                                                                                </button>
                                                                            </form>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        </div>

                                                        <!-- View Details Button -->
                                                        <button type="button" class="btn btn-orange-outline view-rental-btn"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#viewRentalModal"
                                                                data-rental="<?php echo e(json_encode([
                                                                    'customer' => $rental->user->nama_user,
                                                                    'email' => $rental->user->email,
                                                                    'kendaraan' => $rental->kendaraan->nama_kendaraan ?? $rental->kendaraan->merk,
                                                                    'plat_nomor' => $rental->kendaraan->plat_nomor,
                                                                    'tanggal_mulai' => $rental->tanggal_mulai->format('d/m/Y'),
                                                                    'tanggal_selesai' => $rental->tanggal_selesai->format('d/m/Y'),
                                                                    'jumlah_hari' => $rental->jumlah_hari,
                                                                    'total_harga' => 'Rp ' . number_format($rental->total_harga, 0, ',', '.'),
                                                                    'status_sewa' => ucfirst($rental->status_sewa),
                                                                    'created_at' => $rental->created_at->format('d/m/Y H:i')
                                                                ])); ?>"
                                                                title="Lihat Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada data rental</h5>
                                <p class="text-muted">Tunggu customer melakukan pemesanan rental</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View Rental Details -->
<div class="modal fade" id="viewRentalModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content orange-card">
            <div class="modal-header">
                <h5 class="modal-title">Detail Rental</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-orange mb-3">Informasi Customer</h6>
                        <div class="mb-2">
                            <small class="text-muted">Nama Customer</small>
                            <div class="text-white" id="detail-customer">-</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Email</small>
                            <div class="text-white" id="detail-email">-</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-orange mb-3">Informasi Kendaraan</h6>
                        <div class="mb-2">
                            <small class="text-muted">Kendaraan</small>
                            <div class="text-white" id="detail-kendaraan">-</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Plat Nomor</small>
                            <div class="text-white" id="detail-plat">-</div>
                        </div>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-orange mb-3">Periode Sewa</h6>
                        <div class="mb-2">
                            <small class="text-muted">Tanggal Mulai</small>
                            <div class="text-white" id="detail-tanggal-mulai">-</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Tanggal Selesai</small>
                            <div class="text-white" id="detail-tanggal-selesai">-</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Lama Sewa</small>
                            <div class="text-white" id="detail-jumlah-hari">-</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-orange mb-3">Informasi Rental</h6>
                        <div class="mb-2">
                            <small class="text-muted">Total Harga</small>
                            <div class="text-white fw-bold fs-5" id="detail-total-harga">-</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Status</small>
                            <div>
                                <span class="badge bg-warning" id="detail-status">-</span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Tanggal Pemesanan</small>
                            <div class="text-muted" id="detail-created-at">-</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-orange-outline" data-bs-dismiss="modal">Tutup</button>
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
    
    .dropdown-menu {
        background: rgba(26, 26, 26, 0.95);
        border: 1px solid rgba(255, 107, 53, 0.3);
    }
    
    .dropdown-item {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .dropdown-item:hover {
        background: rgba(255, 107, 53, 0.2);
        color: var(--white);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // View Rental Details Modal
        const viewRentalModal = new bootstrap.Modal(document.getElementById('viewRentalModal'));
        const viewButtons = document.querySelectorAll('.view-rental-btn');
        
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const rentalData = JSON.parse(this.getAttribute('data-rental'));
                
                // Fill modal with data
                document.getElementById('detail-customer').textContent = rentalData.customer;
                document.getElementById('detail-email').textContent = rentalData.email;
                document.getElementById('detail-kendaraan').textContent = rentalData.kendaraan;
                document.getElementById('detail-plat').textContent = rentalData.plat_nomor;
                document.getElementById('detail-tanggal-mulai').textContent = rentalData.tanggal_mulai;
                document.getElementById('detail-tanggal-selesai').textContent = rentalData.tanggal_selesai;
                document.getElementById('detail-jumlah-hari').textContent = rentalData.jumlah_hari + ' hari';
                document.getElementById('detail-total-harga').textContent = rentalData.total_harga;
                document.getElementById('detail-created-at').textContent = rentalData.created_at;
                
                // Update status badge
                const statusBadge = document.getElementById('detail-status');
                statusBadge.textContent = rentalData.status_sewa;
                statusBadge.className = 'badge ' + {
                    'pending': 'bg-warning',
                    'berlangsung': 'bg-primary',
                    'selesai': 'bg-success',
                    'dibatalkan': 'bg-danger'
                }[rentalData.status_sewa.toLowerCase()];
                
                viewRentalModal.show();
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SpeedRent\resources\views/admin/rental.blade.php ENDPATH**/ ?>