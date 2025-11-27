

<?php $__env->startSection('title', 'Manajemen Kategori - SpeedRent'); ?>

<?php $__env->startSection('content'); ?>
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
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

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
            <!-- Form Input Kategori -->
            <div class="col-lg-4 mb-4">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-plus-circle me-2 text-orange"></i>
                            <?php echo e(isset($editKategori) ? 'Edit Kategori' : 'Tambah Kategori Baru'); ?>

                        </h5>
                        
                        <form action="<?php echo e(isset($editKategori) ? route('admin.kategori.update', $editKategori->id_kategori) : route('admin.kategori.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($editKategori)): ?>
                                <?php echo method_field('PUT'); ?>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Kategori Kendaraan</label>
                                <select class="form-control dark-select" id="nama_kategori" name="nama_kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Mobil" <?php echo e(old('nama_kategori', $editKategori->nama_kategori ?? '') == 'Mobil' ? 'selected' : ''); ?>>Mobil</option>
                                    <option value="Motor" <?php echo e(old('nama_kategori', $editKategori->nama_kategori ?? '') == 'Motor' ? 'selected' : ''); ?>>Motor</option>
                                </select>
                                <?php $__errorArgs = ['nama_kategori'];
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
                                <label for="jenis" class="form-label">Nama Jenis</label>
                                <input type="text" class="form-control" id="jenis" name="jenis" 
                                       value="<?php echo e(old('jenis', $editKategori->jenis ?? '')); ?>" 
                                       required placeholder="Contoh: SUV, Sedan, Sport, Matic">
                                <?php $__errorArgs = ['jenis'];
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
                                    <?php echo e(isset($editKategori) ? 'Update Kategori' : 'Simpan Kategori'); ?>

                                </button>
                                
                                <?php if(isset($editKategori)): ?>
                                    <a href="<?php echo e(route('admin.kategori')); ?>" class="btn btn-orange-outline">
                                        <i class="fas fa-times me-2"></i>Batal Edit
                                    </a>
                                <?php endif; ?>
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

                        <?php if($kategoris->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">No</th>
                                            <th>Kategori Kendaraan</th>
                                            <th>Nama Jenis</th>
                                            <th>Tanggal Dibuat</th>
                                            <th width="120" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-muted"><?php echo e($index + 1); ?></td>
                                                <td>
                                                    <span class="badge <?php echo e($kategori->nama_kategori == 'Mobil' ? 'bg-primary' : 'bg-success'); ?>">
                                                        <?php echo e($kategori->nama_kategori); ?>

                                                    </span>
                                                </td>
                                                <td class="text-white"><?php echo e($kategori->jenis); ?></td>
                                                <td class="text-muted">
                                                    <?php echo e($kategori->created_at->format('d/m/Y')); ?>

                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="<?php echo e(route('admin.kategori', ['edit' => $kategori->id_kategori])); ?>" 
                                                           class="btn btn-orange-outline" 
                                                           data-bs-toggle="tooltip" 
                                                           title="Edit Kategori">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="<?php echo e(route('admin.kategori.destroy', $kategori->id_kategori)); ?>" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
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
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada kategori</h5>
                                <p class="text-muted">Mulai dengan menambahkan kategori pertama Anda</p>
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

    /* CSS untuk memperbaiki select option yang tidak terlihat */
    .dark-select {
        background-color: #2d3748 !important;
        border-color: #4a5568 !important;
        color: white !important;
    }

    .dark-select:focus {
        background-color: #2d3748 !important;
        border-color: #ff6b35 !important;
        color: white !important;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25) !important;
    }

    .dark-select option {
        background-color: #2d3748 !important;
        color: white !important;
        padding: 8px !important;
    }

    .dark-select option:hover {
        background-color: #ff6b35 !important;
    }

    /* Untuk browser Webkit (Chrome, Safari, Edge) */
    .dark-select::-webkit-list-box {
        background-color: #2d3748 !important;
        color: white !important;
    }

    .dark-select::-webkit-dropdown-list-box {
        background-color: #2d3748 !important;
        color: white !important;
    }

    .dark-select::-webkit-list-item {
        background-color: #2d3748 !important;
        color: white !important;
    }

    .dark-select::-webkit-list-item:hover {
        background-color: #ff6b35 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if(isset($editKategori)): ?>
            document.querySelector('.orange-card').scrollIntoView({
                behavior: 'smooth'
            });
        <?php endif; ?>

        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Force refresh select elements untuk memastikan style diterapkan
        const selectElements = document.querySelectorAll('.dark-select');
        selectElements.forEach(select => {
            select.style.backgroundColor = '#2d3748';
            select.style.color = 'white';
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SpeedRent\resources\views/admin/kategori.blade.php ENDPATH**/ ?>