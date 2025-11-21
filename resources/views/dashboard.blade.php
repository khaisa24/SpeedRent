@extends('layouts.app')

@section('title', 'Dashboard - SpeedRent')

@section('content')
<div class="container mt-4">
    <!-- Welcome Card -->
    <div class="card welcome-card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3>Selamat datang, {{ Auth::user()->nama_user }}! 🎉</h3>
                    <p class="mb-0 opacity-75">Siap menyewa mobil impian Anda?</p>
                </div>
                <div class="col-md-4 text-end">
                    <i class="fas fa-car-side fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- User Statistics -->
    @if(isset($total_rental_saya))
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center p-3">
                    <div class="stats-icon mx-auto" style="background: #28a745;">
                        <i class="fas fa-list-alt"></i>
                    </div>
                    <h4 class="text-white mb-1">{{ $total_rental_saya }}</h4>
                    <h6 class="text-white mb-1">Total Rental</h6>
                    <p class="text-white mb-0 small">Semua waktu</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center p-3">
                    <div class="stats-icon mx-auto" style="background: #ffc107;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4 class="text-white mb-1">{{ $rental_pending }}</h4>
                    <h6 class="text-white mb-1">Pending</h6>
                    <p class="text-white mb-0 small">Menunggu konfirmasi</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center p-3">
                    <div class="stats-icon mx-auto" style="background: #17a2b8;">
                        <i class="fas fa-play-circle"></i>
                    </div>
                    <h4 class="text-white mb-1">{{ $rental_berjalan }}</h4>
                    <h6 class="text-white mb-1">Berjalan</h6>
                    <p class="text-white mb-0 small">Sedang disewa</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center p-3">
                    <div class="stats-icon mx-auto" style="background: #6f42c1;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h4 class="text-white mb-1">{{ $rental_selesai }}</h4>
                    <h6 class="text-white mb-1">Selesai</h6>
                    <p class="text-white mb-0 small">Rental completed</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center p-3">
                    <div class="stats-icon mx-auto">
                        <i class="fas fa-car"></i>
                    </div>
                    <h6 class="text-white mb-1">25+ Mobil</h6>
                    <p class="text-white mb-0 small">Tersedia</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center p-3">
                    <div class="stats-icon mx-auto">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h6 class="text-white mb-1">Flexible</h6>
                    <p class="text-white mb-0 small">Sewa Harian/Bulanan</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center p-3">
                    <div class="stats-icon mx-auto">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h6 class="text-white mb-1">Terjamin</h6>
                    <p class="text-white mb-0 small">Asuransi Lengkap</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Rentals -->
    @if(isset($my_recent_rentals) && $my_recent_rentals->count() > 0)
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card stats-card">
                <div class="card-body">
                    <h6 class="text-white mb-3"><i class="fas fa-history me-2"></i>Rental Terbaru</h6>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Kendaraan</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($my_recent_rentals as $rental)
                                <tr>
                                    <td>{{ $rental->kendaraan->nama_mobil ?? 'N/A' }}</td>
                                    <td>{{ $rental->tanggal_sewa }}</td>
                                    <td>{{ $rental->tanggal_kembali }}</td>
                                    <td>
                                        @if($rental->status_sewa == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($rental->status_sewa == 'berlangsung')
                                            <span class="badge bg-info">Berjalan</span>
                                        @elseif($rental->status_sewa == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $rental->status_sewa }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-orange-outline btn-sm">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card stats-card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-car fa-3x mb-3 opacity-50"></i>
                    <h5 class="text-white">Belum ada riwayat rental</h5>
                    <p class="text-white opacity-75 mb-3">Mulai sewa mobil pertama Anda sekarang!</p>
                    <a href="{{ route('kendaraan.index') }}" class="btn btn-orange-primary">
                        <i class="fas fa-search me-1"></i>Lihat Kendaraan
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Profile Info -->
    <div class="row">
        <div class="col-md-12">
            <div class="card stats-card">
                <div class="card-body">
                    <h6 class="text-white mb-3"><i class="fas fa-user-circle me-2"></i>Informasi Profil</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2 small"><strong>Nama:</strong> {{ Auth::user()->nama_user }}</p>
                            <p class="mb-2 small"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2 small"><strong>Role:</strong> 
                                <span class="badge">{{ ucfirst(Auth::user()->role) }}</span>
                            </p>
                            <p class="mb-0 small"><strong>Status:</strong> <span class="badge bg-success">Aktif</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .welcome-card {
        background: linear-gradient(135deg, var(--dark) 0%, #1a1a1a 100%);
        color: var(--white);
        border-radius: 12px;
        border: 1px solid rgba(255, 107, 53, 0.2);
    }
    .stats-card {
        border: none;
        border-radius: 12px;
        background: rgba(26, 26, 26, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
    }
    
    .stats-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 1rem;
        background: var(--orange);
        color: var(--white);
    }
    
    .table-dark {
        background: transparent;
        border-color: rgba(255, 255, 255, 0.1);
    }
    
    .table-dark th,
    .table-dark td {
        border-color: rgba(255, 255, 255, 0.1);
        color: var(--white);
    }
</style>
@endsection