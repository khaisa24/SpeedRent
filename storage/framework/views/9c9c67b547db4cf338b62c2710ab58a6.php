<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpeedRent - <?php echo $__env->yieldContent('title'); ?></title>
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
        }
        
        /* Global Background */
        body {
            background: linear-gradient(135deg, var(--black) 0%, var(--dark) 100%);
            min-height: 100vh;
            color: var(--white);
            margin: 0;
            padding: 0;
        }
        
        /* Auth Container */
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }
        
        /* Navbar Styles - UPDATED */
        .nav-hero {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 1rem 0;
            background: transparent;
        }
        
        .nav-hero .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .nav-hero .navbar-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            align-items: center;
        }
        
        /* Button Styles - UPDATED */
        .btn-orange-primary {
            background: linear-gradient(135deg, var(--orange) 0%, var(--orange-light) 100%);
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
            color: var(--white);
            transition: all 0.3s ease;
            font-size: 0.85rem;
            white-space: nowrap;
            flex-shrink: 0;
        }
        
        .btn-orange-outline {
            border: 2px solid var(--orange);
            color: var(--orange);
            background: transparent;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.85rem;
            white-space: nowrap;
            flex-shrink: 0;
        }
        
        .btn-orange-outline:hover {
            background: var(--orange);
            color: var(--white);
        }
        
        .btn-orange-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
            color: var(--white);
        }
        
        /* Card Styles */
        .auth-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            background: rgba(26, 26, 26, 0.95);
            border: 1px solid rgba(255, 107, 53, 0.3);
            position: relative;
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            margin-top: 2rem;
        }
        
        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--orange) 0%, var(--orange-light) 100%);
        }
        
        .auth-card .card-body {
            padding: 2.5rem;
        }
        
        /* Auth Header */
        .auth-header {
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .auth-header .car-icon {
            color: var(--orange);
            margin-bottom: 1rem;
        }
        
        .auth-header .logo-text {
            color: var(--white);
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 1.8rem;
        }
        
        .auth-title {
            color: var(--white);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .auth-subtitle {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0;
            font-size: 0.95rem;
        }
        
        /* Form Styles */
        .form-control {
            border-radius: 8px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            padding: 12px 15px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.05);
            color: var(--white);
            font-size: 0.95rem;
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
        
        .form-label {
            color: var(--white);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .form-check-input:checked {
            background-color: var(--orange);
            border-color: var(--orange);
        }
        
        .form-check-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
        }
        
        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            padding: 0.75rem 1rem;
        }
        
        .alert-success {
            background-color: rgba(40, 167, 69, 0.2);
            color: #75b798;
            border-left: 4px solid #28a745;
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.2);
            color: #ea868f;
            border-left: 4px solid #dc3545;
        }
        
        .alert .btn-close {
            filter: invert(1);
            padding: 0.75rem;
        }
        
        /* Text Styles */
        .auth-link {
            color: var(--orange);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .auth-link:hover {
            color: var(--orange-light);
        }
        
        .auth-text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        
        /* Error Messages */
        .text-danger {
            color: #ff6b6b !important;
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }

        /* Responsive Design - UPDATED */
        @media (max-width: 768px) {
            .nav-hero .container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-hero .navbar-brand {
                margin-bottom: 0.5rem;
            }
            
            .nav-hero .navbar-nav {
                justify-content: center;
                width: 100%;
            }
            
            .btn-orange-primary,
            .btn-orange-outline {
                font-size: 0.8rem;
                padding: 6px 12px;
            }
            
            .auth-card {
                margin-top: 4rem;
            }
        }
        
        @media (max-width: 576px) {
            .auth-card .card-body {
                padding: 2rem 1.5rem;
            }
            
            .auth-container {
                padding: 15px;
            }
            
            .auth-header .logo-text {
                font-size: 1.5rem;
            }
            
            .nav-hero .navbar-nav {
                flex-wrap: nowrap;
                overflow-x: auto;
                justify-content: flex-start;
                padding-bottom: 0.5rem;
            }
            
            .btn-orange-primary,
            .btn-orange-outline {
                font-size: 0.75rem;
                padding: 5px 10px;
            }
            
            .auth-card {
                margin-top: 5rem;
            }
        }
        
        @media (max-width: 400px) {
            .auth-card .card-body {
                padding: 1.5rem 1rem;
            }
            
            .nav-hero .navbar-nav {
                gap: 0.25rem;
            }
            
            .btn-orange-primary,
            .btn-orange-outline {
                font-size: 0.7rem;
                padding: 4px 8px;
            }
        }

        /* Additional spacing for better mobile experience */
        @media (max-width: 360px) {
            .auth-container {
                padding: 10px;
            }
            
            .auth-card {
                margin-top: 6rem;
            }
        }
    </style>
</head>
<body>
    <?php echo $__env->yieldContent('content'); ?>
</body>
</html><?php /**PATH C:\laragon\www\SpeedRent\resources\views/layouts/loginregister.blade.php ENDPATH**/ ?>