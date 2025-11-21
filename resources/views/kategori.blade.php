<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpeedRent - Manajemen Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --black: #000000;
            --dark: #0a0a0a;
            --gray: #1a1a1a;
            --orange: #FF6B35;
            --orange-light: #FF8C42;
            --white: #ffffff;
            --sidebar-width: 280px;
        }
        
        /* Global Background */
        .orange-bg {
            background: linear-gradient(135deg, var(--black) 0%, var(--dark) 100%);
            min-height: 100vh;
            color: var(--white);
        }
        
        /* Layout Structure */
        .main-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: rgba(10, 10, 10, 0.95);
            border-right: 1px solid rgba(255, 107, 53, 0.2);
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 107, 53, 0.2);
            text-align: center;
        }
        
        .sidebar-brand {
            color: var(--white);
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
        }
        
        .sidebar-brand:hover {
            color: var(--white);
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .nav-item {
            margin-bottom: 0.25rem;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1.5rem;
            border-radius: 0;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        
        .nav-link:hover {
            color: var(--white);
            background: rgba(255, 107, 53, 0.1);
            border-left-color: var(--orange);
        }
        
        .nav-link.active {
            color: var(--white);
            background: rgba(255, 107, 53, 0.2);
            border-left-color: var(--orange);
        }
        
        .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }
        
        .nav-link .badge {
            margin-left: auto;
            font-size: 0.6rem;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }
        
        /* Top Navigation */
        .top-navbar {
            background: rgba(10, 10, 10, 0.95);
            border-bottom: 1px solid rgba(255, 107, 53, 0.2);
            padding: 1rem 0;
        }
        
        /* Auth Pages */
        .auth-container {
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
        }
        
        /* Card Styles */
        .orange-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            background: rgba(26, 26, 26, 0.9);
            border: 1px solid rgba(255, 107, 53, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .orange-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--orange) 0%, var(--orange-light) 100%);
        }
        
        /* Button Styles */
        .btn-orange-primary {
            background: linear-gradient(135deg, var(--orange) 0%, var(--orange-light) 100%);
            border: none;
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            color: var(--white);
            transition: all 0.3s ease;
        }
        
        .btn-orange-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
            color: var(--white);
        }
        
        .btn-orange-outline {
            background: transparent;
            border: 2px solid var(--orange);
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            color: var(--orange);
            transition: all 0.3s ease;
        }
        
        .btn-orange-outline:hover {
            background: var(--orange);
            color: var(--white);
            transform: translateY(-2px);
        }
        
        /* Form Styles */
        .form-control {
            border-radius: 8px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            padding: 10px 15px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.05);
            color: var(--white);
        }
        
        .form-control:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.1);
            background: rgba(255, 255, 255, 0.08);
            color: var(--white);
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        /* Text Styles */
        .logo-text {
            color: var(--white);
            font-weight: 700;
        }
        
        .car-icon {
            color: var(--orange);
        }
        
        .text-orange {
            color: var(--orange) !important;
        }
        
        /* Dashboard Specific */
        .dashboard-container {
            background: linear-gradient(135deg, var(--black) 0%, var(--dark) 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        
        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
        }
        
        /* Table Styles */
        .table-dark {
            background: transparent;
            border-color: rgba(255, 255, 255, 0.1);
        }
        
        .table-dark th,
        .table-dark td {
            border-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
        }
        
        .table-dark thead th {
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.8);
        }
        
        /* Badge Styles */
        .badge {
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.35em 0.65em;
        }
        
        .bg-primary { background-color: #4299e1 !important; }
        .bg-success { background-color: #48bb78 !important; }
        .bg-warning { background-color: #ed8936 !important; }
        
        /* Labels & Links */
        label {
            color: var(--white);
            font-weight: 600;
        }
        
        a {
            color: var(--orange);
            text-decoration: none;
        }
        
        a:hover {
            color: var(--orange-light);
        }
        
        .text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        
        .auth-subtitle {
            color: rgba(255, 255, 255, 0.8);
        }
        
        /* User Info */
        .user-info {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--orange);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: bold;
            margin-right: 0.75rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
        }
        
        /* Kategori Specific Styles */
        .kategori-container {
            padding: 2rem 0;
        }
        
        .kategori-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .kategori-title {
            color: var(--white);
            font-weight: 700;
            margin-bottom: 0;
        }
        
        .kategori-actions {
            display: flex;
            gap: 1rem;
        }
        
        .table-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: rgba(255, 255, 255, 0.6);
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.3);
        }
        
        .form-section {
            margin-bottom: 2rem;
        }
        
        .form-section-title {
            color: var(--white);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(255, 107, 53, 0.3);
        }
    </style>
</head>
<body class="orange-bg">
    <div class="main-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <a href="/" class="sidebar-brand">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    SPEED<span style="color: var(--orange);">RENT</span>
                </a>
            </div>

            <!-- Sidebar Menu -->
            <nav class="sidebar-menu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="fas fa-tags"></i>
                            Kategori
                            <span class="badge bg-warning">New</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-car-side"></i>
                            Kendaraan
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-tag"></i>
                            Harga
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-clipboard-list"></i>
                            Manajemen Rental
                            <span class="badge bg-primary">5</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-credit-card"></i>
                            Pembayaran
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            Laporan
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            Manajemen User
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Info -->
            <div class="user-info">
                <div class="d-flex align-items-center">
                    <div class="user-avatar">
                        A
                    </div>
                    <div>
                        <div class="small fw-bold text-white">Admin User</div>
                        <div class="small text-muted">Administrator</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navigation -->
            <nav class="top-navbar">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Menu Toggle for Mobile -->
                        <button class="btn btn-orange-outline btn-sm d-md-none menu-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <!-- Page Title -->
                        <h5 class="mb-0 text-white">Manajemen Kategori</h5>
                        
                        <!-- User Actions -->
                        <div class="navbar-nav ms-auto">
                            <span class="navbar-text me-3 d-none d-md-block">
                                <i class="fas fa-user me-1"></i> Admin User
                            </span>
                            <button class="btn btn-orange-outline btn-sm">
                                <i class="fas fa-sign-out-alt me-1"></i>Logout
                            </button>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content Area -->
            <div class="content-wrapper">
                <div class="container kategori-container">
                    <div class="kategori-header">
                        <h1 class="kategori-title">
                            <i class="fas fa-tags me-2"></i>Daftar Kategori
                        </h1>
                        <div class="kategori-actions">
                            <button class="btn btn-orange-outline" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
                                <i class="fas fa-plus me-1"></i>Tambah Kategori
                            </button>
                            <button class="btn btn-orange-primary">
                                <i class="fas fa-sync-alt me-1"></i>Refresh
                            </button>
                        </div>
                    </div>

                    <!-- Form Input Kategori Baru -->
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="orange-card p-4">
                                <h3 class="form-section-title">
                                    <i class="fas fa-plus-circle me-2"></i>Tambah Kategori Baru
                                </h3>
                                <form id="formKategoriBaru">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama kategori" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="jenis" class="form-label">Jenis</label>
                                            <select class="form-control" id="jenis" name="jenis" required>
                                                <option value="" disabled selected>Pilih jenis kategori</option>
                                                <option value="Mobil">Mobil</option>
                                                <option value="Motor">Motor</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-orange-outline me-2">
                                            <i class="fas fa-times me-1"></i>Batal
                                        </button>
                                        <button type="submit" class="btn btn-orange-primary">
                                            <i class="fas fa-save me-1"></i>Simpan Kategori
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Kategori -->
                    <div class="row">
                        <div class="col-12">
                            <div class="orange-card p-4">
                                <h3 class="form-section-title">
                                    <i class="fas fa-list me-2"></i>Daftar Semua Kategori
                                </h3>
                                
                                <div class="table-responsive">
                                    <table class="table table-dark table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Kategori</th>
                                                <th>Jenis</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Terakhir Diupdate</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>SUV</td>
                                                <td><span class="badge bg-primary">Mobil</span></td>
                                                <td>2023-10-15 08:30:00</td>
                                                <td>2023-10-15 08:30:00</td>
                                                <td>
                                                    <div class="table-actions">
                                                        <button class="btn btn-sm btn-orange-outline btn-action">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger btn-action">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Sedan</td>
                                                <td><span class="badge bg-primary">Mobil</span></td>
                                                <td>2023-10-14 14:20:00</td>
                                                <td>2023-10-16 09:45:00</td>
                                                <td>
                                                    <div class="table-actions">
                                                        <button class="btn btn-sm btn-orange-outline btn-action">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger btn-action">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Sport</td>
                                                <td><span class="badge bg-warning">Motor</span></td>
                                                <td>2023-10-12 11:15:00</td>
                                                <td>2023-10-12 11:15:00</td>
                                                <td>
                                                    <div class="table-actions">
                                                        <button class="btn btn-sm btn-orange-outline btn-action">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger btn-action">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Matic</td>
                                                <td><span class="badge bg-warning">Motor</span></td>
                                                <td>2023-10-10 16:40:00</td>
                                                <td>2023-10-13 10:20:00</td>
                                                <td>
                                                    <div class="table-actions">
                                                        <button class="btn btn-sm btn-orange-outline btn-action">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger btn-action">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Pickup</td>
                                                <td><span class="badge bg-success">Lainnya</span></td>
                                                <td>2023-10-08 09:55:00</td>
                                                <td>2023-10-08 09:55:00</td>
                                                <td>
                                                    <div class="table-actions">
                                                        <button class="btn btn-sm btn-orange-outline btn-action">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger btn-action">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Empty State (untuk contoh jika tidak ada data) -->
                                <!--
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h4>Belum ada kategori</h4>
                                    <p>Mulai dengan menambahkan kategori pertama Anda.</p>
                                    <button class="btn btn-orange-primary mt-2">
                                        <i class="fas fa-plus me-1"></i>Tambah Kategori Pertama
                                    </button>
                                </div>
                                -->
                                
                                <!-- Pagination -->
                                <nav aria-label="Page navigation" class="mt-4">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                                <i class="fas fa-chevron-left"></i>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const sidebar = document.querySelector('.sidebar');
            
            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 768) {
                    const isClickInsideSidebar = sidebar.contains(event.target);
                    const isClickInsideMenuToggle = menuToggle.contains(event.target);
                    
                    if (!isClickInsideSidebar && !isClickInsideMenuToggle && sidebar.classList.contains('show')) {
                        sidebar.classList.remove('show');
                    }
                }
            });
            
            // Form submission handler
            const formKategoriBaru = document.getElementById('formKategoriBaru');
            if (formKategoriBaru) {
                formKategoriBaru.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Get form values
                    const namaKategori = document.getElementById('nama_kategori').value;
                    const jenis = document.getElementById('jenis').value;
                    
                    // In a real application, you would send this data to the server
                    console.log('Data kategori baru:', {
                        nama_kategori: namaKategori,
                        jenis: jenis
                    });
                    
                    // Show success message
                    alert(`Kategori "${namaKategori}" berhasil ditambahkan!`);
                    
                    // Reset form
                    formKategoriBaru.reset();
                });
            }
        });
    </script>
</body>
</html>