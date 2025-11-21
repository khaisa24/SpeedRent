<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpeedRent - @yield('title')</title>
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
            --sidebar-collapsed: 80px;
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
            overflow-x: hidden;
        }
        
        .sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }
        
        .sidebar.collapsed .sidebar-brand span,
        .sidebar.collapsed .nav-link span:not(.badge),
        .sidebar.collapsed .user-info .user-details {
            display: none;
        }
        
        .sidebar.collapsed .sidebar-brand {
            justify-content: center;
        }
        
        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 0.75rem;
        }
        
        .sidebar.collapsed .nav-link i {
            margin-right: 0;
            font-size: 1.3rem;
        }
        
        .sidebar.collapsed .user-info {
            padding: 1rem 0.5rem;
            text-align: center;
        }
        
        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 107, 53, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .sidebar-brand {
            color: var(--white);
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        
        .sidebar-brand:hover {
            color: var(--white);
        }
        
        .toggle-btn {
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .toggle-btn:hover {
            background: rgba(255, 107, 53, 0.2);
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
            white-space: nowrap;
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
            flex-shrink: 0;
        }
        
        .nav-link .badge {
            margin-left: auto;
            font-size: 0.6rem;
            flex-shrink: 0;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }
        
        .main-content.expanded {
            margin-left: var(--sidebar-collapsed);
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
            flex-shrink: 0;
        }
        
        .user-details {
            flex: 1;
        }
        
        /* Tooltip for collapsed sidebar */
        .nav-link[data-bs-toggle="tooltip"] {
            position: relative;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
                width: var(--sidebar-width);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .sidebar.collapsed {
                transform: translateX(-100%);
            }
        }
    </style>
</head>
<body class="orange-bg">
    <div class="main-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <a href="/" class="sidebar-brand">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    <span>SPEED<span style="color: var(--orange);">RENT</span></span>
                </a>
                <button class="toggle-btn" id="sidebarToggle">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>

            <!-- Sidebar Menu -->
            <nav class="sidebar-menu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.kategori') }}" class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                            <i class="fas fa-tags"></i>
                            <span>Kategori</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.kendaraan') }}" class="nav-link {{ request()->routeIs('admin.kendaraan.*') ? 'active' : '' }}">
                            <i class="fas fa-car-side"></i>
                            <span>Kendaraan</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.harga') }}" class="nav-link {{ request()->routeIs('admin.harga*') ? 'active' : '' }}">
                            <i class="fas fa-tag"></i>
                            <span>Harga</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.rental') }}" class="nav-link {{ request()->routeIs('admin.rental*') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Manajemen Rental</span>
                            <span class="badge bg-primary">{{ $rental_aktif ?? 0 }}</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.pembayaran') }}" class="nav-link {{ request()->routeIs('admin.pembayaran*') ? 'active' : '' }}">
                            <i class="fas fa-credit-card"></i>
                            <span>Pembayaran</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.laporan') }}" class="nav-link {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
                            <i class="fas fa-chart-bar"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Manajemen User</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Info -->
            @auth
            <div class="user-info">
                <div class="d-flex align-items-center">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->nama_user, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <div class="small fw-bold text-white">{{ Auth::user()->nama_user }}</div>
                        <div class="small text-muted">{{ Auth::user()->role }}</div>
                    </div>
                </div>
            </div>
            @endauth
        </aside>

        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Top Navigation -->
            <nav class="top-navbar">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Menu Toggle for Mobile -->
                        <button class="btn btn-orange-outline btn-sm d-md-none menu-toggle" id="mobileMenuToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <!-- Page Title -->
                        <h5 class="mb-0 text-white">@yield('title', 'Dashboard')</h5>
                        
                        <!-- User Actions -->
                        <div class="navbar-nav ms-auto">
                            @auth
                                <span class="navbar-text me-3 d-none d-md-block">
                                    <i class="fas fa-user me-1"></i> {{ Auth::user()->nama_user }}
                                </span>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-orange-outline btn-sm">
                                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-orange-outline btn-sm me-2">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-orange-primary btn-sm">
                                    <i class="fas fa-user-plus me-1"></i>Register
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content Area -->
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            
            // Toggle sidebar collapse/expand
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('expanded');
                    
                    // Rotate chevron icon
                    const icon = this.querySelector('i');
                    if (sidebar.classList.contains('collapsed')) {
                        icon.classList.remove('fa-chevron-left');
                        icon.classList.add('fa-chevron-right');
                    } else {
                        icon.classList.remove('fa-chevron-right');
                        icon.classList.add('fa-chevron-left');
                    }
                });
            }
            
            // Mobile menu toggle
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                    
                    // Reset desktop toggle icon
                    const desktopIcon = sidebarToggle.querySelector('i');
                    desktopIcon.classList.remove('fa-chevron-right');
                    desktopIcon.classList.add('fa-chevron-left');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 768) {
                    const isClickInsideSidebar = sidebar.contains(event.target);
                    const isClickInsideMenuToggle = mobileMenuToggle.contains(event.target);
                    
                    if (!isClickInsideSidebar && !isClickInsideMenuToggle && sidebar.classList.contains('show')) {
                        sidebar.classList.remove('show');
                    }
                }
            });
            
            // Initialize tooltips for collapsed sidebar
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>