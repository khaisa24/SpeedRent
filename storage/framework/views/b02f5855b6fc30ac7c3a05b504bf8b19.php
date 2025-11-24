

<?php $__env->startSection('title', 'Manajemen Harga - SpeedRent'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="text-white mb-1">Manajemen Harga</h2>
                        <p class="text-muted mb-0">Kelola harga sewa kendaraan di SpeedRent</p>
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
            <!-- Form Input Harga -->
            <div class="col-lg-4 mb-4">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-money-bill-wave me-2 text-orange"></i>
                            <?php echo e(isset($editHarga) ? 'Edit Harga' : 'Tambah Harga Baru'); ?>

                        </h5>
                        
                        <form action="<?php echo e(isset($editHarga) ? route('admin.harga.update', $editHarga->id_harga) : route('admin.harga.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($editHarga)): ?>
                                <?php echo method_field('PUT'); ?>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="id_kendaraan" class="form-label">Kendaraan</label>
                                <select class="form-control" id="id_kendaraan" name="id_kendaraan" required>
                                    <option value="">Pilih Kendaraan</option>
                                    <?php $__currentLoopData = $kendaraans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kendaraan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($kendaraan->id_kendaraan); ?>" 
                                            <?php echo e(old('id_kendaraan', $editHarga->id_kendaraan ?? '') == $kendaraan->id_kendaraan ? 'selected' : ''); ?>>
                                            <?php echo e($kendaraan->merk); ?> <?php echo e($kendaraan->model); ?> (<?php echo e($kendaraan->plat_nomor); ?>)
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

                            <div class="mb-3">
                                <label for="harga_perhari" class="form-label">Harga Per Hari (Rp)</label>
                                <input type="number" class="form-control" id="harga_perhari" name="harga_perhari" 
                                       value="<?php echo e(old('harga_perhari', $editHarga->harga_perhari ?? '')); ?>" 
                                       required min="0" step="1000" placeholder="Contoh: 150000">
                                <?php $__errorArgs = ['harga_perhari'];
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

                            <div class="mb-4">
                                <label for="tanggal_berlaku" class="form-label">Tanggal Berlaku</label>
                                <input type="date" class="form-control" id="tanggal_berlaku" name="tanggal_berlaku" 
                                       value="<?php echo e(old('tanggal_berlaku', isset($editHarga) ? $editHarga->tanggal_berlaku->format('Y-m-d') : '')); ?>" 
                                       required>
                                <?php $__errorArgs = ['tanggal_berlaku'];
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

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-orange-primary">
                                    <i class="fas fa-save me-2"></i>
                                    <?php echo e(isset($editHarga) ? 'Update Harga' : 'Simpan Harga'); ?>

                                </button>
                                
                                <?php if(isset($editHarga)): ?>
                                    <a href="<?php echo e(route('admin.harga')); ?>" class="btn btn-orange-outline">
                                        <i class="fas fa-times me-2"></i>Batal Edit
                                    </a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Daftar Harga -->
            <div class="col-lg-8">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-list me-2 text-orange"></i>
                            Daftar Harga Sewa
                        </h5>

                        <?php if($hargas->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th>Kendaraan</th>
                                            <th>Harga/Hari</th>
                                            <th>Tanggal Berlaku</th>
                                            <th>Status</th>
                                            <th width="120" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $hargas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $harga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $isActive = $harga->tanggal_berlaku <= now();
                                            ?>
                                            <tr>
                                                <td class="text-muted"><?php echo e($index + 1); ?></td>
                                                <td>
                                                    <div class="text-white"><?php echo e($harga->kendaraan->merk); ?> <?php echo e($harga->kendaraan->model); ?></div>
                                                    <small class="text-muted"><?php echo e($harga->kendaraan->plat_nomor); ?></small>
                                                </td>
                                                <td class="text-white">
                                                    Rp <?php echo e(number_format($harga->harga_perhari, 0, ',', '.')); ?>

                                                </td>
                                                <td class="text-muted">
                                                    <?php echo e($harga->tanggal_berlaku->format('d/m/Y')); ?>

                                                </td>
                                                <td>
                                                    <span class="badge <?php echo e($isActive ? 'bg-success' : 'bg-warning'); ?>">
                                                        <?php echo e($isActive ? 'Aktif' : 'Akan Datang'); ?>

                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="<?php echo e(route('admin.harga', ['edit' => $harga->id_harga])); ?>" 
                                                           class="btn btn-orange-outline" 
                                                           data-bs-toggle="tooltip" 
                                                           title="Edit Harga">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="<?php echo e(route('admin.harga.destroy', $harga->id_harga)); ?>" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus harga ini?')">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" 
                                                                    class="btn btn-orange-outline" 
                                                                    data-bs-toggle="tooltip" 
                                                                    title="Hapus Harga">
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
                                <i class="fas fa-money-bill-wave fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada data harga</h5>
                                <p class="text-muted">Mulai dengan menambahkan harga pertama Anda</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Additional Styles for Harga Page */
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
        <?php if(isset($editHarga)): ?>
            document.querySelector('.orange-card').scrollIntoView({
                behavior: 'smooth'
            });
        <?php endif; ?>

        // Set default tanggal berlaku ke hari ini untuk form baru
        <?php if(!isset($editHarga)): ?>
            document.getElementById('tanggal_berlaku').valueAsDate = new Date();
        <?php endif; ?>

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SpeedRent\resources\views/admin/harga.blade.php ENDPATH**/ ?>