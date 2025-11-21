@extends('layouts.app')

@section('title', 'Dashboard - SpeedRent')

@section('content')
<div class="dashboard-container">
    <div class="container-fluid py-4">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card orange-card">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="auth-header">
                                    <div class="car-icon mb-2">
                                        <i class="fas fa-tachometer-alt fa-2x"></i>
                                    </div>
                                    <h4 class="logo-text mb-2">Selamat Datang, {{ Auth::user()->nama_user }}! 👋</h4>
                                    <p class="auth-subtitle mb-0">
                                        @if(Auth::user()->role === 'admin')
                                            Kelola sistem rental kendaraan dengan mudah
                                        @else
                                            Temukan kendaraan perfect untuk perjalanan Anda
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="date-info small">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    {{ now()->translatedFormat('l, d F Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            @if(Auth::user()->role === 'admin')
                <!-- Admin Statistics -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card orange-card stat-card">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="small fw-semibold text-muted">Total Kendaraan</div>
                                    <div class="h4 fw-bold text-white">{{ $total_kendaraan ?? 0 }}</div>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-key fa-2x text-orange"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card orange-card stat-card">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="small fw-semibold text-muted">Rental Aktif</div>
                                    <div class="h4 fw-bold text-white">{{ $rental_aktif ?? 0 }}</div>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-clipboard-list fa-2x text-orange"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card orange-card stat-card">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="small fw-semibold text-muted">Pending Requests</div>
                                    <div class="h4 fw-bold text-white">{{ $pending_requests ?? 0 }}</div>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-clock fa-2x text-orange"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card orange-card stat-card">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="small fw-semibold text-muted">Kendaraan Tersedia</div>
                                    <div class="h4 fw-bold text-white">{{ $available_vehicles->count() ?? 0 }}</div>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-car-side fa-2x text-orange"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- User Statistics -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card orange-card stat-card">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="small fw-semibold text-muted">Rental Saya</div>
                                    <div class="h4 fw-bold text-white">{{ $total_rental_saya ?? 0 }}</div>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-history fa-2x text-orange"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card orange-card stat-card">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="small fw-semibold text-muted">Sedang Berjalan</div>
                                    <div class="h4 fw-bold text-white">{{ $rental_berjalan ?? 0 }}</div>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-play-circle fa-2x text-orange"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card orange-card stat-card">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="small fw-semibold text-muted">Selesai</div>
                                    <div class="h4 fw-bold text-white">{{ $rental_selesai ?? 0 }}</div>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-check-circle fa-2x text-orange"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card orange-card stat-card">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="small fw-semibold text-muted">Menunggu</div>
                                    <div class="h4 fw-bold text-white">{{ $rental_pending ?? 0 }}</div>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-clock fa-2x text-orange"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Content Row -->
        <div class="row">
            @if(Auth::user()->role === 'admin')
                <!-- Admin Content -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card orange-card mb-4">
                        <div class="card-header bg-transparent border-bottom-0 py-3">
                            <h6 class="m-0 fw-bold text-white">Rental Terbaru</h6>
                        </div>
                        <div class="card-body p-0">
                            @if(isset($recent_rentals) && $recent_rentals->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-dark table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="small fw-semibold border-0">Customer</th>
                                            <th class="small fw-semibold border-0">Kendaraan</th>
                                            <th class="small fw-semibold border-0">Tanggal Sewa</th>
                                            <th class="small fw-semibold border-0">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recent_rentals as $rental)
                                        <tr>
                                            <td class="small">{{ $rental->user->nama_user ?? 'N/A' }}</td>
                                            <td class="small">{{ $rental->kendaraan->nama_mobil ?? 'N/A' }}</td>
                                            <td class="small">{{ $rental->tanggal_sewa ?? 'N/A' }}</td>
                                            <td>
                                                @if($rental->status_sewa == 'pending')
                                                    <span class="badge bg-warning small">Pending</span>
                                                @elseif($rental->status_sewa == 'berlangsung')
                                                    <span class="badge bg-primary small">Berjalan</span>
                                                @elseif($rental->status_sewa == 'selesai')
                                                    <span class="badge bg-success small">Selesai</span>
                                                @else
                                                    <span class="badge bg-secondary small">{{ $rental->status_sewa }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-5">
                                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                                <p class="text-muted small">Belum ada data rental</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5">
                    <div class="card orange-card mb-4">
                        <div class="card-header bg-transparent border-bottom-0 py-3">
                            <h6 class="m-0 fw-bold text-white">Kendaraan Tersedia</h6>
                        </div>
                        <div class="card-body">
                            @if(isset($available_vehicles) && $available_vehicles->count() > 0)
                                @foreach($available_vehicles as $vehicle)
                                <div class="mb-3 p-3 border rounded" style="background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1) !important;">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="fw-bold mb-1 small text-white">{{ $vehicle->kendaraan->nama_mobil ?? 'N/A' }}</h6>
                                            <small class="text-muted">{{ $vehicle->kendaraan->merk ?? 'N/A' }}</small>
                                        </div>
                                        <span class="badge bg-success small">
                                            <i class="fas fa-car-side me-1"></i>Tersedia
                                        </span>
                                    </div>
                                    <div class="mt-2">
                                        <small class="fw-semibold text-white">Rp {{ number_format($vehicle->harga_per_hari ?? 0, 0, ',', '.') }}/hari</small>
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <div class="text-center py-4">
                                <i class="fas fa-car fa-3x text-muted mb-3"></i>
                                <p class="text-muted small">Tidak ada kendaraan tersedia</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <!-- User Content -->
                <div class="col-lg-8">
                    <div class="card orange-card mb-4">
                        <div class="card-header bg-transparent border-bottom-0 py-3">
                            <h6 class="m-0 fw-bold text-white">Rental Terbaru Saya</h6>
                        </div>
                        <div class="card-body p-0">
                            @if(isset($my_recent_rentals) && $my_recent_rentals->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-dark table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="small fw-semibold border-0">Kendaraan</th>
                                            <th class="small fw-semibold border-0">Tanggal Sewa</th>
                                            <th class="small fw-semibold border-0">Tanggal Kembali</th>
                                            <th class="small fw-semibold border-0">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($my_recent_rentals as $rental)
                                        <tr>
                                            <td class="small">{{ $rental->kendaraan->nama_mobil ?? 'N/A' }}</td>
                                            <td class="small">{{ $rental->tanggal_sewa ?? 'N/A' }}</td>
                                            <td class="small">{{ $rental->tanggal_kembali ?? 'N/A' }}</td>
                                            <td>
                                                @if($rental->status_sewa == 'pending')
                                                    <span class="badge bg-warning small">Pending</span>
                                                @elseif($rental->status_sewa == 'berlangsung')
                                                    <span class="badge bg-primary small">Berjalan</span>
                                                @elseif($rental->status_sewa == 'selesai')
                                                    <span class="badge bg-success small">Selesai</span>
                                                @else
                                                    <span class="badge bg-secondary small">{{ $rental->status_sewa }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-5">
                                <i class="fas fa-history fa-3x text-muted mb-3"></i>
                                <p class="text-muted small mb-3">Belum ada riwayat rental</p>
                                <a href="#" class="btn btn-orange-primary btn-sm">Sewa Kendaraan Sekarang</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Quick Actions -->
                    <div class="card orange-card mb-4">
                        <div class="card-header bg-transparent border-bottom-0 py-3">
                            <h6 class="m-0 fw-bold text-white">Aksi Cepat</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="#" class="btn btn-orange-primary btn-sm py-2">
                                    <i class="fas fa-car me-2"></i>Sewa Kendaraan
                                </a>
                                <a href="#" class="btn btn-outline-orange btn-sm py-2">
                                    <i class="fas fa-user me-2"></i>Lengkapi Profil
                                </a>
                                <a href="#" class="btn btn-outline-orange btn-sm py-2">
                                    <i class="fas fa-history me-2"></i>Lihat Riwayat
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Completion -->
                    <div class="card orange-card border-warning mb-4">
                        <div class="card-header bg-warning bg-opacity-10 border-warning py-3">
                            <h6 class="m-0 fw-bold text-warning">Lengkapi Profil Anda</h6>
                        </div>
                        <div class="card-body">
                            <p class="small text-muted mb-3">Lengkapi profil untuk dapat menyewa kendaraan</p>
                            <div class="progress mb-3" style="height: 8px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <a href="#" class="btn btn-warning btn-sm w-100 py-2">Lengkapi Sekarang</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Additional styling untuk table dark */
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

    .date-info.small {
        color: rgba(255, 255, 255, 0.8);
    }
</style>
@endsection