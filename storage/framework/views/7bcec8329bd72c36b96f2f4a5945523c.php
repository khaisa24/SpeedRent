

<?php $__env->startSection('title', 'Login - SpeedRent'); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="auth-card">
                    <div class="card-body p-4">
                        <!-- Auth Header -->
                        <div class="auth-header text-center mb-4">
                            <div class="car-icon mb-3">
                                <i class="fas fa-car fa-3x"></i>
                            </div>
                            <h2 class="logo-text mb-2">SPEED<span style="color: var(--orange);">RENT</span></h2>
                            <h4 class="auth-title mb-1">LOGIN</h4>
                            <p class="auth-subtitle mb-0">Masuk ke akun Anda</p>
                        </div>

                        <!-- Alerts -->
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

                        <!-- Login Form -->
                        <form action="<?php echo e(route('login')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            
                            <!-- Email Field -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent">
                                        <i class="fas fa-envelope text-orange"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo e(old('email')); ?>" required autofocus
                                           placeholder="email@contoh.com">
                                </div>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent">
                                        <i class="fas fa-lock text-orange"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password" required
                                           placeholder="Masukkan password Anda">
                                </div>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <a href="#" class="auth-link small">Lupa password?</a>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-orange-primary w-100 py-3 mb-4 fw-bold">
                                <i class="fas fa-sign-in-alt me-2"></i>LOGIN
                            </button>
                            
                            <!-- Register Link -->
                            <div class="text-center">
                                <p class="mb-0 auth-text-muted">Belum punya akun? 
                                    <a href="<?php echo e(route('register')); ?>" class="auth-link fw-bold">
                                        Daftar Sekarang
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

<style>
    /* Fix untuk input group border */
    .input-group-text {
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-right: none;
        background: rgba(255, 255, 255, 0.05) !important;
        color: rgba(255, 255, 255, 0.7) !important;
        border-radius: 8px 0 0 8px;
    }
    
    .input-group .form-control {
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-left: none;
        border-radius: 0 8px 8px 0;
        padding-left: 12px;
    }
    
    .input-group .form-control:focus {
        border-color: var(--orange);
        border-left: none;
    }
    
    .input-group:focus-within .input-group-text {
        border-color: var(--orange);
        border-right: none;
    }
    
    .input-group:focus-within .form-control {
        border-color: var(--orange);
        border-left: none;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.loginregister', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SpeedRent\resources\views/auth/login.blade.php ENDPATH**/ ?>