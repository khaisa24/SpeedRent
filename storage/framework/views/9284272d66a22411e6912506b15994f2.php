

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

        <div class="row">
            <!-- Form Input Rental -->
            <div class="col-lg-4 mb-4">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-plus-circle me-2 text-orange"></i>
                            <?php echo e(isset($editRental) ? 'Edit Rental' : 'Tambah Rental Baru'); ?>

                        </h5>
                        
                        <form action="<?php echo e(isset($editRental) ? route('admin.rental.update', $editRental->id_rental) : route('admin.rental.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($editRental)): ?>
                                <?php echo method_field('PUT'); ?>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="id_user" class="form-label">Customer</label>
                                <select class="form-control" id="id_user" name="id_user" required>
                                    <option value="">Pilih Customer</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user->id_user); ?>" 
                                            <?php echo e(old('id_user', $editRental->id_user ?? '') == $user->id_user ? 'selected' : ''); ?>>
                                            <?php echo e($user->nama_user); ?> (<?php echo e($user->email); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['id_user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label for="id_kendaraan" class="form-label">Kendaraan</label>
                                <select class="form-control" id="id_kendaraan" name="id_kendaraan" required>
                                    <option value="">Pilih Kendaraan</option>
                                    <?php $__currentLoopData = $kendaraans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kendaraan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($kendaraan->id_kendaraan); ?>" 
                                            <?php echo e(old('id_kendaraan', $editRental->id_kendaraan ?? '') == $kendaraan->id_kendaraan ? 'selected' : ''); ?>

                                            data-harga="<?php echo e($kendaraan->harga_perhari ?? 0); ?>">
                                            <?php echo e($kendaraan->merk); ?> <?php echo e($kendaraan->model); ?> - <?php echo e($kendaraan->plat_nomor); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['id_kendaraan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" 
                                               value="<?php echo e(old('tanggal_mulai', isset($editRental) ? $editRental->tanggal_mulai->format('Y-m-d') : '')); ?>" 
                                               required>
                                        <?php $__errorArgs = ['tanggal_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" 
                                               value="<?php echo e(old('tanggal_selesai', isset($editRental) ? $editRental->tanggal_selesai->format('Y-m-d') : '')); ?>" 
                                               required>
                                        <?php $__errorArgs = ['tanggal_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="status_sewa" class="form-label">Status Sewa</label>
                                <select class="form-control" id="status_sewa" name="status_sewa" required>
                                    <option value="pending" <?php echo e(old('status_sewa', $editRental->status_sewa ?? '') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="berlangsung" <?php echo e(old('status_sewa', $editRental->status_sewa ?? '') == 'berlangsung' ? 'selected' : ''); ?>>Berlangsung</option>
                                    <option value="selesai" <?php echo e(old('status_sewa', $editRental->status_sewa ?? '') == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                                    <option value="dibatalkan" <?php echo e(old('status_sewa', $editRental->status_sewa ?? '') == 'dibatalkan' ? 'selected' : ''); ?>>Dibatalkan</option>
                                </select>
                                <?php $__errorArgs = ['status_sewa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <?php if(isset($editRental)): ?>
                                <div class="mb-3 p-3 bg-dark rounded">
                                    <small class="text-muted">Total Harga</small>
                                    <div class="text-orange fw-bold fs-5">
                                        Rp <?php echo e(number_format($editRental->total_harga, 0, ',', '.')); ?>

                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-orange-primary">
                                    <i class="fas fa-save me-2"></i>
                                    <?php echo e(isset($editRental) ? 'Update Rental' : 'Simpan Rental'); ?>

                                </button>
                                
                                <?php if(isset($editRental)): ?>
                                    <a href="<?php echo e(route('admin.rental')); ?>" class="btn btn-orange-outline">
                                        <i class="fas fa-times me-2"></i>Batal Edit
                                    </a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Daftar Rental -->
            <div class="col-lg-8">
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
                                            <th>Periode</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th width="150" class="text-center">Aksi</th>
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
                                                    <div class="text-white"><?php echo e($rental->kendaraan->merk); ?> <?php echo e($rental->kendaraan->model); ?></div>
                                                    <small class="text-muted"><?php echo e($rental->kendaraan->plat_nomor); ?></small>
                                                </td>
                                                <td class="text-muted">
                                                    <div><?php echo e($rental->tanggal_mulai->format('d/m/Y')); ?></div>
                                                    <small>s/d <?php echo e($rental->tanggal_selesai->format('d/m/Y')); ?></small>
                                                </td>
                                                <td class="text-white">
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
                                                        <a href="<?php echo e(route('admin.rental', ['edit' => $rental->id_rental])); ?>" 
                                                           class="btn btn-orange-outline" 
                                                           data-bs-toggle="tooltip" 
                                                           title="Edit Rental">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        
                                                        <!-- Quick Status Update -->
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-orange-outline dropdown-toggle" data-bs-toggle="dropdown" title="Ubah Status">
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

                                                        <form action="<?php echo e(route('admin.rental.destroy', $rental->id_rental)); ?>" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus rental ini?')">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" 
                                                                    class="btn btn-orange-outline" 
                                                                    data-bs-toggle="tooltip" 
                                                                    title="Hapus Rental">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
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
                                <p class="text-muted">Mulai dengan menambahkan rental pertama Anda</p>
                            </div>
                        <?php endif; ?>
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
        // Auto scroll to form when editing
        <?php if(isset($editRental)): ?>
            document.querySelector('.orange-card').scrollIntoView({
                behavior: 'smooth'
            });
        <?php endif; ?>

        // Set default tanggal untuk form baru
        <?php if(!isset($editRental)): ?>
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_mulai').value = today;
            
            // Set tanggal selesai default 1 hari setelah mulai
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            document.getElementById('tanggal_selesai').value = tomorrow.toISOString().split('T')[0];
        <?php endif; ?>

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SpeedRent\resources\views/admin/rental.blade.php ENDPATH**/ ?>