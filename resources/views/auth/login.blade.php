@extends('layouts.loginregister')

@section('title', 'Login - SpeedRent')

@section('content')
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
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                @foreach($errors->all() as $error)
                                    <div class="small">{{ $error }}</div>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            
                            <!-- Email Field -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent">
                                        <i class="fas fa-envelope text-orange"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email') }}" required autofocus
                                           placeholder="email@contoh.com">
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
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
                                @error('password')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
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
                                    <a href="{{ route('register') }}" class="auth-link fw-bold">
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
@endsection