<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpeedRent - Rental Mobil Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --black: #000000;
            --dark: #0a0a0a;
            --orange: #FF6B35;
            --orange-light: #FF8C42;
            --white: #ffffff;
            --light-gray: #e2e8f0;
        }
        
        .hero-section {
            background: linear-gradient(135deg, rgba(0,0,0,0.85) 0%, rgba(10,10,10,0.9) 100%), 
                        url("/storage/kendaraan/daftar-mobil.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
            color: var(--white);
            position: relative;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .nav-hero {
            background: rgba(10, 10, 10, 0.95);
            border-bottom: 1px solid rgba(255, 107, 53, 0.2);
            position: relative;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }
        
        .btn-orange-primary {
            background: linear-gradient(135deg, var(--orange) 0%, var(--orange-light) 100%);
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            color: var(--white);
            transition: all 0.3s ease;
        }
        
        .btn-orange-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
            color: var(--white);
        }
        
        .btn-orange-outline {
            background: transparent;
            border: 2px solid var(--orange);
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            color: var(--orange);
            transition: all 0.3s ease;
        }
        
        .btn-orange-outline:hover {
            background: var(--orange);
            color: var(--white);
            transform: translateY(-2px);
        }
        
        .car-card {
            background: rgba(26, 26, 26, 0.9);
            border: 1px solid rgba(255, 107, 53, 0.2);
            border-radius: 12px;
            transition: transform 0.3s ease;
            height: 100%;
            backdrop-filter: blur(10px);
        }
        
        .car-card:hover {
            transform: translateY(-5px);
            border-color: var(--orange);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            background: var(--orange);
            color: var(--white);
            margin: 0 auto 1rem;
            transition: transform 0.3s ease;
        }
        
        .feature-icon:hover {
            transform: rotate(10deg) scale(1.1);
        }
        
        .car-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }
        
        .car-card:hover .car-image {
            transform: scale(1.05);
        }
        
        .bg-orange {
            background-color: var(--orange) !important;
        }
        
        .text-orange {
            color: var(--orange) !important;
        }
        
        .car-placeholder {
            width: 100%;
            height: 200px;
            background: rgba(255, 107, 53, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }
        
        .car-card:hover .car-placeholder {
            background: rgba(255, 107, 53, 0.2);
            transform: scale(1.05);
        }
        
        /* Perbaikan warna teks */
        .text-white-75 {
            color: rgba(255, 255, 255, 0.75) !important;
        }
        
        .text-white-60 {
            color: rgba(255, 255, 255, 0.6) !important;
        }
        
        .text-white-50 {
            color: rgba(255, 255, 255, 0.5) !important;
        }
        
        .car-desc {
            color: rgba(255, 255, 255, 0.7) !important;
            font-size: 0.875rem;
        }
        
        .feature-desc {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        
        .cta-desc {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
        
        /* Section spacing */
        .section-spacing {
            padding: 5rem 0;
        }
        
        /* Responsive improvements */
        @media (max-width: 768px) {
            .hero-section {
                background-attachment: scroll;
                background-position: center center;
            }
            
            .display-4 {
                font-size: 2.5rem;
            }
            
            .btn-orange-primary,
            .btn-orange-outline {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 576px) {
            .display-4 {
                font-size: 2rem;
            }
            
            .section-spacing {
                padding: 3rem 0;
            }
        }
    </style>
</head>
<body class="hero-section">
    <!-- Navigation -->
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
            </div>
        </div>
    </nav>

    <!-- Hero Section dengan Background Image -->
    <div class="container hero-content">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6 fade-in-up">
                <h1 class="display-4 fw-bold mb-4 text-white">
                    Sewa Kendaraan <span style="color: var(--orange);">Premium</span> dengan Harga Terjangkau
                </h1>
                <p class="lead mb-4 text-white-75">
                    Temukan berbagai pilihan Kendaraan terbaik untuk kebutuhan perjalanan Anda. 
                    Dari city car hingga Kendaraan keluarga, semua tersedia dengan kondisi terawat.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-orange-primary">
                        <i class=""></i>Sewa Sekarang
                    </a>
                    <a href="#mobil" class="btn btn-orange-outline">
                        <i class=""></i>Lihat Kendaraan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container section-spacing">
        <div class="row text-center">
            <div class="col-md-4 mb-4 fade-in-up">
                <div class="feature-icon">
                    <i class="fas fa-car"></i>
                </div>
                <h5 class="text-white">Kendaraan Berkualitas</h5>
                <p class="feature-desc">Semua kendaraan dalam kondisi prima dan terawat dengan standar tinggi</p>
            </div>
            <div class="col-md-4 mb-4 fade-in-up">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h5 class="text-white">Asuransi Lengkap</h5>
                <p class="feature-desc">Perlindungan komprehensif untuk keamanan dan kenyamanan perjalanan Anda</p>
            </div>
            <div class="col-md-4 mb-4 fade-in-up">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h5 class="text-white">24/7 Support</h5>
                <p class="feature-desc">Tim support profesional siap membantu kapan saja Anda membutuhkan</p>
            </div>
        </div>
    </div>

    <!-- Cars Section -->
    <div id="mobil" class="container section-spacing">
        <h2 class="text-center mb-5 text-white fade-in-up">Kendaraan Tersedia</h2>
        
        <?php if(isset($mobilTersedia) && $mobilTersedia->count() > 0): ?>
            <div class="row">
                <?php $__currentLoopData = $mobilTersedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mobil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 mb-4 fade-in-up">
                    <div class="car-card p-4 text-center">
                        <!-- Foto Mobil -->
                        <?php if($mobil->foto && file_exists(public_path('storage/' . $mobil->foto))): ?>
                            <img src="<?php echo e(asset('storage/' . $mobil->foto)); ?>" alt="<?php echo e($mobil->nama_kendaraan); ?>" class="car-image">
                        <?php else: ?>
                            <div class="car-placeholder">
                                <i class="fas fa-car fa-3x text-orange"></i>
                            </div>
                        <?php endif; ?>
                        
                        <h5 class="text-white"><?php echo e($mobil->nama_kendaraan); ?></h5>
                        <p class="car-desc"><?php echo e($mobil->deskripsi ?: 'Mobil premium berkualitas tinggi'); ?></p>
                        
                        <div class="mb-3">
                            <span class="badge bg-orange me-1"><?php echo e($mobil->merek); ?></span>
                            <span class="badge bg-orange me-1"><?php echo e($mobil->bahan_bakar); ?></span>
                            <span class="badge bg-orange"><?php echo e($mobil->kapasitas); ?> Seat</span>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-white-60">
                                <i class="fas fa-palette me-1"></i><?php echo e($mobil->warna); ?> | 
                                <i class="fas fa-tag me-1 ms-2"></i><?php echo e($mobil->plat_nomor); ?>

                            </small>
                        </div>
                        
                        <!-- Harga -->
                        <?php if(isset($mobil->harga) && $mobil->harga->harga_perhari): ?>
                            <h5 class="text-orange">Rp <?php echo e(number_format($mobil->harga->harga_perhari, 0, ',', '.')); ?>/hari</h5>
                        <?php else: ?>
                            <h5 class="text-orange">Hubungi untuk harga</h5>
                        <?php endif; ?>
                        
                        <div class="mt-3">
                            <span class="badge bg-success"><?php echo e($mobil->status); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <!-- Demo cars jika tidak ada data -->
            <div class="row">
                <!-- Car 1 -->
                <div class="col-md-4 mb-4 fade-in-up">
                    <div class="car-card p-4 text-center">
                        <div class="car-placeholder">
                            <i class="fas fa-car fa-3x text-orange"></i>
                        </div>
                        <h5 class="text-white">Toyota Fortuner</h5>
                        <p class="car-desc">SUV tangguh dan nyaman</p>
                        <div class="mb-3">
                            <span class="badge bg-orange me-1">Diesel</span>
                            <span class="badge bg-orange">2.8L</span>
                        </div>
                        <h5 class="text-orange">Rp 600.000/hari</h5>
                    </div>
                </div>
                
                <!-- Car 2 -->
                <div class="col-md-4 mb-4 fade-in-up">
                    <div class="car-card p-4 text-center">
                        <div class="car-placeholder">
                            <i class="fas fa-car fa-3x text-orange"></i>
                        </div>
                        <h5 class="text-white">Honda Brio</h5>
                        <p class="car-desc">City car ekonomis dan irit</p>
                        <div class="mb-3">
                            <span class="badge bg-orange me-1">Automatic</span>
                            <span class="badge bg-orange">1.2L</span>
                        </div>
                        <h5 class="text-orange">Rp 250.000/hari</h5>
                    </div>
                </div>
                
                <!-- Car 3 -->
                <div class="col-md-4 mb-4 fade-in-up">
                    <div class="car-card p-4 text-center">
                        <div class="car-placeholder">
                            <i class="fas fa-car fa-3x text-orange"></i>
                        </div>
                        <h5 class="text-white">Toyota Innova</h5>
                        <p class="car-desc">MPV mewah dan nyaman untuk keluarga</p>
                        <div class="mb-3">
                            <span class="badge bg-orange me-1">Diesel</span>
                            <span class="badge bg-orange">2.4L</span>
                        </div>
                        <h5 class="text-orange">Rp 500.000/hari</h5>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- CTA Section -->
        <div class="text-center mt-5 fade-in-up">
            <h3 class="mb-3 text-white">Siap Memulai Perjalanan?</h3>
            <p class="cta-desc mb-4">Daftar sekarang dan nikmati pengalaman sewa Kendaraan terbaik dengan layanan premium</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="<?php echo e(route('register')); ?>" class="btn btn-orange-primary btn-lg">
                    <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                </a>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-orange-outline btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-white">
                        <i class=""></i>SPEED<span class="text-orange">RENT</span>
                    </h5>
                    <p class="text-white-60 mb-0">Layanan rental kendaraan premium terpercaya sejak 2024</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-white-60 mb-0">&copy; 2025 SpeedRent. By LEO.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Animasi scroll untuk smooth navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll untuk anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            
            // Animasi fade in on scroll
            const fadeElements = document.querySelectorAll('.fade-in-up');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });
            
            fadeElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                observer.observe(el);
            });
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\SpeedRent\resources\views/welcome.blade.php ENDPATH**/ ?>