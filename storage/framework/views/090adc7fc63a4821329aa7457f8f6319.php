

<?php $__env->startSection('title', 'Register - SpeedRent'); ?>
<?php $__env->startSection('auth-subtitle', 'Bergabung dengan SpeedRent'); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-container">

    <nav class="navbar navbar-expand-lg nav-hero">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <span style="font-size: 1.5rem; color: var(--white);">
                    <i class=""></i>SPEED<span style="color: var(--orange);">RENT</span>
                </span>
            </a>
            <div class="navbar-nav ms-auto">
                <a href="<?php echo e(route('login')); ?>" class="btn btn-orange-outline btn-sm me-2">
                    <i class="fas fa-sign-in-alt me-1"></i>Login
                </a>
                <a href="<?php echo e(route('register')); ?>" class="btn btn-orange-primary btn-sm">
                    <i class="fas fa-user-plus me-1"></i>Register
                </a>
                <a href="<?php echo e(route('home')); ?>" class="btn btn-orange-primary btn-sm">
                    <i class="fas fa-home me-1"></i>Home
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="auth-card">
                    <div class="card-body p-4">
                        <!-- Auth Header -->
                        <div class="auth-header text-center mb-4">
                            <div class="car-icon mb-3">
                                <i class="fas fa-car-side fa-3x"></i>
                            </div>
                            <h2 class="logo-text mb-2">SPEED<span style="color: var(--orange);">RENT</span></h2>
                            <h4 class="auth-title mb-1">DAFTAR AKUN</h4>
                            <p class="auth-subtitle mb-0">Bergabung dengan SpeedRent</p>
                        </div>

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

                        <form action="<?php echo e(route('register')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_user" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama_user" name="nama_user" 
                                               value="<?php echo e(old('nama_user')); ?>" required autofocus
                                               placeholder="Nama lengkap">
                                        <?php $__errorArgs = ['nama_user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="<?php echo e(old('email')); ?>" required
                                               placeholder="email@contoh.com">
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required
                                               placeholder="Minimal 8 karakter">
                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" 
                                               name="password_confirmation" required
                                               placeholder="Ulangi password">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Saya menyetujui Syarat & Ketentuan
                                    </label>
                                    <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-orange-primary w-100 py-3 mb-3 fw-bold">
                                <i class="fas fa-user-plus me-2"></i>DAFTAR SEKARANG
                            </button>
                            
                            <div class="text-center">
                                <p class="mb-0 auth-text-muted">Sudah punya akun? 
                                    <a href="<?php echo e(route('login')); ?>" class="auth-link">
                                        Login di sini
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.loginregister', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SpeedRent\resources\views/auth/register.blade.php ENDPATH**/ ?>