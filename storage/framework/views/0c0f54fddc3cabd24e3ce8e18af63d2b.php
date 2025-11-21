

<?php $__env->startSection('title', 'Data Pembayaran - SpeedRent'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-white mb-0"><i class="fas fa-credit-card me-2"></i>Data Pembayaran</h2>
                    <div class="d-flex">
                        <span class="badge bg-info me-2 p-2">
                            <i class="fas fa-money-bill-wave me-1"></i>
                            Total: Rp <?php echo e(number_format($totalPembayaran, 0, ',', '.')); ?>

                        </span>
                        <span class="badge bg-warning p-2">
                            <i class="fas fa-clock me-1"></i>
                            Pending: <?php echo e($pendingCount); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Data Pembayaran Card -->
        <div class="orange-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark table-hover" id="table-pembayaran">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>ID Rental</th>
                                <th>User</th>
                                <th>Metode Bayar</th>
                                <th>Jumlah Bayar</th>
                                <th>Bukti Bayar</th>
                                <th>Tanggal Bayar</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $pembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                <td>
                                    <span class="badge bg-secondary">#<?php echo e($item->id_rental); ?></span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                            <?php echo e(strtoupper(substr($item->user->nama_user ?? 'N/A', 0, 1))); ?>

                                        </div>
                                        <div>
                                            <div class="small text-white"><?php echo e($item->user->nama_user ?? 'N/A'); ?></div>
                                            <div class="small text-muted"><?php echo e($item->user->email ?? ''); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-<?php echo e($item->metode_pembayaran == 'transfer' ? 'success' : 'primary'); ?>">
                                        <i class="fas fa-<?php echo e($item->metode_pembayaran == 'transfer' ? 'university' : 'money-bill-wave'); ?> me-1"></i>
                                        <?php echo e(strtoupper($item->metode_pembayaran)); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="text-success fw-bold">
                                        Rp <?php echo e(number_format($item->jumlah_bayar, 0, ',', '.')); ?>

                                    </span>
                                </td>
                                <td>
                                    <?php if($item->bukti_bayar): ?>
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#buktiModal<?php echo e($item->id_pembayaran); ?>">
                                            <i class="fas fa-eye me-1"></i>Lihat Bukti
                                        </button>
                                    <?php else: ?>
                                        <span class="text-muted"><i class="fas fa-times me-1"></i>Tidak ada</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        <?php echo e($item->created_at->format('d/m/Y H:i')); ?>

                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetail<?php echo e($item->id_pembayaran); ?>" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="<?php echo e(route('admin.pembayaran.edit', $item->id_pembayaran)); ?>" class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.pembayaran.destroy', $item->id_pembayaran)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus data pembayaran?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Modal Detail -->
                                    <div class="modal fade" id="modalDetail<?php echo e($item->id_pembayaran); ?>" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content orange-card">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-white">
                                                        <i class="fas fa-receipt me-2"></i>Detail Pembayaran
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">ID Pembayaran</label>
                                                            <div class="text-white p-2 bg-dark rounded">#<?php echo e($item->id_pembayaran); ?></div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">ID Rental</label>
                                                            <div class="text-white p-2 bg-dark rounded">#<?php echo e($item->id_rental); ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">User</label>
                                                            <div class="text-white p-2 bg-dark rounded">
                                                                <i class="fas fa-user me-2"></i><?php echo e($item->user->nama_user ?? 'N/A'); ?>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Email</label>
                                                            <div class="text-white p-2 bg-dark rounded">
                                                                <i class="fas fa-envelope me-2"></i><?php echo e($item->user->email ?? 'N/A'); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Metode Pembayaran</label>
                                                            <div class="p-2 bg-dark rounded">
                                                                <span class="badge bg-<?php echo e($item->metode_pembayaran == 'transfer' ? 'success' : 'primary'); ?>">
                                                                    <i class="fas fa-<?php echo e($item->metode_pembayaran == 'transfer' ? 'university' : 'money-bill-wave'); ?> me-1"></i>
                                                                    <?php echo e(strtoupper($item->metode_pembayaran)); ?>

                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Jumlah Bayar</label>
                                                            <div class="text-success fw-bold p-2 bg-dark rounded">
                                                                <i class="fas fa-money-bill-wave me-2"></i>
                                                                Rp <?php echo e(number_format($item->jumlah_bayar, 0, ',', '.')); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Tanggal Pembayaran</label>
                                                            <div class="text-white p-2 bg-dark rounded">
                                                                <i class="fas fa-calendar me-2"></i>
                                                                <?php echo e($item->created_at->format('d F Y H:i:s')); ?>

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

                                    <!-- Modal Bukti Bayar -->
                                    <?php if($item->bukti_bayar): ?>
                                    <div class="modal fade" id="buktiModal<?php echo e($item->id_pembayaran); ?>" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content orange-card">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-white">
                                                        <i class="fas fa-image me-2"></i>Bukti Pembayaran
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="<?php echo e(asset('storage/' . $item->bukti_bayar)); ?>" 
                                                         alt="Bukti Bayar" 
                                                         class="img-fluid rounded" 
                                                         style="max-height: 500px;">
                                                    <div class="mt-3">
                                                        <a href="<?php echo e(asset('storage/' . $item->bukti_bayar)); ?>" 
                                                           download 
                                                           class="btn btn-orange-primary">
                                                            <i class="fas fa-download me-1"></i>Download Bukti
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-credit-card fa-3x mb-3"></i>
                                        <h5>Tidak ada data pembayaran</h5>
                                        <p>Belum ada transaksi pembayaran yang tercatat</p>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if($pembayaran->hasPages()): ?>
                <div class="mt-4">
                    <?php echo e($pembayaran->links()); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Auto-close alerts setelah 5 detik
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SpeedRent\resources\views/admin/pembayaran.blade.php ENDPATH**/ ?>