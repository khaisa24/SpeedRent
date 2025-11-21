@extends('layouts.loginregister')

@section('title', 'Register - SpeedRent')
@section('auth-subtitle', 'Bergabung dengan SpeedRent')

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
                                <i class="fas fa-car-side fa-3x"></i>
                            </div>
                            <h2 class="logo-text mb-2">SPEED<span style="color: var(--orange);">RENT</span></h2>
                            <h4 class="auth-title mb-1">DAFTAR AKUN</h4>
                            <p class="auth-subtitle mb-0">Bergabung dengan SpeedRent</p>
                        </div>

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

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_user" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama_user" name="nama_user" 
                                               value="{{ old('nama_user') }}" required autofocus
                                               placeholder="Nama lengkap">
                                        @error('nama_user')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="{{ old('email') }}" required
                                               placeholder="email@contoh.com">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required
                                               placeholder="Minimal 8 karakter">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                                    @error('terms')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-orange-primary w-100 py-3 mb-3 fw-bold">
                                <i class="fas fa-user-plus me-2"></i>DAFTAR SEKARANG
                            </button>
                            
                            <div class="text-center">
                                <p class="mb-0 auth-text-muted">Sudah punya akun? 
                                    <a href="{{ route('login') }}" class="auth-link">
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
@endsection