

<?php $__env->startSection('title', 'Manajemen User - SpeedRent'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="text-white mb-1">Manajemen User</h2>
                        <p class="text-muted mb-0">Kelola pengguna sistem SpeedRent</p>
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
            <!-- Form Input User -->
            <div class="col-lg-4 mb-4">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-plus-circle me-2 text-orange"></i>
                            <?php echo e(isset($editUser) ? 'Edit User' : 'Tambah User Baru'); ?>

                        </h5>
                        
                        <form action="<?php echo e(isset($editUser) ? route('admin.users.update', $editUser->id_user) : route('admin.users.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($editUser)): ?>
                                <?php echo method_field('PUT'); ?>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="nama_user" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_user" name="nama_user" 
                                       value="<?php echo e(old('nama_user', $editUser->nama_user ?? '')); ?>" 
                                       required placeholder="Nama lengkap user">
                                <?php $__errorArgs = ['nama_user'];
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
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?php echo e(old('email', $editUser->email ?? '')); ?>" 
                                       required placeholder="email@contoh.com">
                                <?php $__errorArgs = ['email'];
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
                                <label for="password" class="form-label">
                                    Password 
                                    <?php if(isset($editUser)): ?>
                                        <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small>
                                    <?php endif; ?>
                                </label>
                                <input type="password" class="form-control" id="password" name="password" 
                                       <?php echo e(isset($editUser) ? '' : 'required'); ?>

                                       placeholder="<?php echo e(isset($editUser) ? 'Password baru...' : 'Minimal 8 karakter'); ?>">
                                <?php $__errorArgs = ['password'];
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
                                <label for="role" class="form-label">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="user" <?php echo e(old('role', $editUser->role ?? '') == 'user' ? 'selected' : ''); ?>>User</option>
                                    <option value="admin" <?php echo e(old('role', $editUser->role ?? '') == 'admin' ? 'selected' : ''); ?>>Admin</option>
                                </select>
                                <?php $__errorArgs = ['role'];
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
                                    <?php echo e(isset($editUser) ? 'Update User' : 'Simpan User'); ?>

                                </button>
                                
                                <?php if(isset($editUser)): ?>
                                    <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-orange-outline">
                                        <i class="fas fa-times me-2"></i>Batal Edit
                                    </a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Daftar Users -->
            <div class="col-lg-8">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-list me-2 text-orange"></i>
                            Daftar Pengguna
                        </h5>

                        <?php if($users->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th>User</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Bergabung</th>
                                            <th width="120" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-muted"><?php echo e($index + 1); ?></td>
                                                <td>
                                                    <div class="text-white"><?php echo e($user->nama_user); ?></div>
                                                    <?php if($user->id_user == auth()->id()): ?>
                                                        <small class="text-orange">(Anda)</small>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-muted"><?php echo e($user->email); ?></td>
                                                <td>
                                                    <?php if($user->role == 'admin'): ?>
                                                        <span class="badge bg-danger">Admin</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-primary">User</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-muted">
                                                    <?php echo e($user->created_at->format('d/m/Y')); ?>

                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="<?php echo e(route('admin.users', ['edit' => $user->id_user])); ?>" 
                                                           class="btn btn-orange-outline" 
                                                           data-bs-toggle="tooltip" 
                                                           title="Edit User">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        
                                                        <?php if($user->id_user != auth()->id()): ?>
                                                            <form action="<?php echo e(route('admin.users.destroy', $user->id_user)); ?>" 
                                                                  method="POST" 
                                                                  class="d-inline"
                                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus user <?php echo e($user->nama_user); ?>?')">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <button type="submit" 
                                                                        class="btn btn-orange-outline" 
                                                                        data-bs-toggle="tooltip" 
                                                                        title="Hapus User">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        <?php else: ?>
                                                            <button class="btn btn-orange-outline" disabled
                                                                    data-bs-toggle="tooltip" 
                                                                    title="Tidak dapat menghapus akun sendiri">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Statistik -->
                            <div class="mt-4 pt-3 border-top">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="text-primary fw-bold fs-5"><?php echo e($users->where('role', 'admin')->count()); ?></div>
                                        <small class="text-muted">Admin</small>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-success fw-bold fs-5"><?php echo e($users->where('role', 'user')->count()); ?></div>
                                        <small class="text-muted">User</small>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-warning fw-bold fs-5"><?php echo e($users->count()); ?></div>
                                        <small class="text-muted">Total</small>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada data user</h5>
                                <p class="text-muted">Mulai dengan menambahkan user pertama</p>
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
    
    .border-top {
        border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto scroll to form when editing
        <?php if(isset($editUser)): ?>
            document.querySelector('.orange-card').scrollIntoView({
                behavior: 'smooth'
            });
        <?php endif; ?>

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SpeedRent\resources\views/admin/users.blade.php ENDPATH**/ ?>