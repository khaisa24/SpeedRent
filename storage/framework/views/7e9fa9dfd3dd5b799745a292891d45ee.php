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
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--black) 0%, var(--dark) 100%);
            min-height: 100vh;
            color: var(--white);
        }
        
        .nav-hero {
            background: rgba(10, 10, 10, 0.95);
            border-bottom: 1px solid rgba(255, 107, 53, 0.2);
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
        }
        
        .car-card:hover {
            transform: translateY(-5px);
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
        }
    </style>
</head>
<body class="hero-section">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg nav-hero">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <span style="font-size: 1.5rem; color: var(--white);">
                    <i class="fas fa-car-side me-2"></i>SPEED<span style="color: var(--orange);">RENT</span>
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

    <!-- Hero Section -->
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    Sewa Mobil <span style="color: var(--orange);">Premium</span> dengan Harga Terjangkau
                </h1>
                <p class="lead mb-4 opacity-75">
                    Temukan berbagai pilihan mobil terbaik untuk kebutuhan perjalanan Anda. 
                    Dari city car hingga mobil keluarga, semua tersedia dengan kondisi terawat.
                </p>
                <div class="d-flex gap-3">
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-orange-primary">
                        <i class="fas fa-car me-2"></i>Sewa Sekarang
                    </a>
                    <a href="#mobil" class="btn btn-orange-outline">
                        <i class="fas fa-search me-2"></i>Lihat Mobil
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-car-side fa-8x opacity-25"></i>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container py-5">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="feature-icon">
                    <i class="fas fa-car"></i>
                </div>
                <h5>Mobil Berkualitas</h5>
                <p class="text-muted">Semua mobil dalam kondisi prima dan terawat</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h5>Asuransi Lengkap</h5>
                <p class="text-muted">Perlindungan komprehensif untuk keamanan Anda</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h5>24/7 Support</h5>
                <p class="text-muted">Tim support siap membantu kapan saja</p>
            </div>
        </div>
    </div>

    <!-- Cars Section -->
    <div id="mobil" class="container py-5">
        <h2 class="text-center mb-5">Mobil Tersedia</h2>
        <div class="row">
            <!-- Car 1 -->
            <div class="col-md-4 mb-4">
                <div class="car-card p-4 text-center">
                    <i class="fas fa-car fa-3x mb-3" style="color: var(--orange);"></i>
                    <h5>Toyota Avanza</h5>
                    <p class="text-muted small">Mobil keluarga 7-seater</p>
                    <div class="mb-3">
                        <span class="badge bg-orange me-1">Manual</span>
                        <span class="badge bg-orange">1.5L</span>
                    </div>
                    <h5 class="text-orange">Rp 300.000/hari</h5>
                </div>
            </div>
            
            <!-- Car 2 -->
            <div class="col-md-4 mb-4">
                <div class="car-card p-4 text-center">
                    <i class="fas fa-car fa-3x mb-3" style="color: var(--orange);"></i>
                    <h5>Honda Brio</h5>
                    <p class="text-muted small">City car ekonomis</p>
                    <div class="mb-3">
                        <span class="badge bg-orange me-1">Automatic</span>
                        <span class="badge bg-orange">1.2L</span>
                    </div>
                    <h5 class="text-orange">Rp 250.000/hari</h5>
                </div>
            </div>
            
            <!-- Car 3 -->
            <div class="col-md-4 mb-4">
                <div class="car-card p-4 text-center">
                    <i class="fas fa-car fa-3x mb-3" style="color: var(--orange);"></i>
                    <h5>Toyota Innova</h5>
                    <p class="text-muted small">MPV mewah dan nyaman</p>
                    <div class="mb-3">
                        <span class="badge bg-orange me-1">Diesel</span>
                        <span class="badge bg-orange">2.4L</span>
                    </div>
                    <h5 class="text-orange">Rp 500.000/hari</h5>
                </div>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div class="text-center mt-5">
            <h3 class="mb-3">Siap Memulai Perjalanan?</h3>
            <p class="text-muted mb-4">Daftar sekarang dan nikmati pengalaman sewa mobil terbaik</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="<?php echo e(route('register')); ?>" class="btn btn-orange-primary btn-lg">
                    <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                </a>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-orange-outline btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\laragon\www\SpeedRent\resources\views/welcome.blade.php ENDPATH**/ ?>