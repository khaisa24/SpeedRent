@extends('layouts.app')

@section('title', 'Laporan - SpeedRent')

@section('content')
<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="text-white mb-1">Laporan & Analitik</h2>
                        <p class="text-muted mb-0">Dashboard lengkap untuk analisis bisnis SpeedRent</p>
                    </div>
                    
                    <!-- Filter Periode -->
                    <div class="d-flex gap-3 align-items-center">
                        <form method="GET" class="d-flex gap-2">
                            <select name="periode" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="hari_ini" {{ $periode == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                                <option value="minggu_ini" {{ $periode == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                                <option value="bulan_ini" {{ $periode == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                                <option value="tahun_ini" {{ $periode == 'tahun_ini' ? 'selected' : '' }}>Tahun Ini</option>
                                <option value="semua" {{ $periode == 'semua' ? 'selected' : '' }}>Semua Waktu</option>
                            </select>
                            <button type="submit" class="btn btn-orange-outline btn-sm">
                                <i class="fas fa-filter"></i>
                            </button>
                        </form>
                        <button class="btn btn-orange-primary btn-sm">
                            <i class="fas fa-download me-1"></i>Export
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Utama -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="orange-card text-center stat-card">
                    <div class="card-body">
                        <i class="fas fa-money-bill-wave fa-2x text-success mb-3"></i>
                        <h3 class="text-success">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
                        <p class="text-muted mb-0">Total Pendapatan</p>
                        <small class="text-muted">Periode: {{ ucfirst(str_replace('_', ' ', $periode)) }}</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="orange-card text-center stat-card">
                    <div class="card-body">
                        <i class="fas fa-car-side fa-2x text-primary mb-3"></i>
                        <h3 class="text-primary">{{ number_format($total_transaksi, 0, ',', '.') }}</h3>
                        <p class="text-muted mb-0">Total Transaksi</p>
                        <small class="text-muted">Rental diselesaikan</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="orange-card text-center stat-card">
                    <div class="card-body">
                        <i class="fas fa-chart-line fa-2x text-warning mb-3"></i>
                        <h3 class="text-warning">Rp {{ number_format($rata_rata_sewa, 0, ',', '.') }}</h3>
                        <p class="text-muted mb-0">Rata-rata per Rental</p>
                        <small class="text-muted">Nilai transaksi rata-rata</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Kendaraan Terpopuler -->
            <div class="col-lg-6 mb-4">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-crown me-2 text-warning"></i>
                            Kendaraan Terpopuler
                        </h5>
                        
                        @if($kendaraan_terpopuler->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th>Kendaraan</th>
                                            <th>Plat</th>
                                            <th class="text-center">Total Sewa</th>
                                            <th class="text-center">Peringkat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kendaraan_terpopuler as $index => $populer)
                                            <tr>
                                                <td>
                                                    <div class="text-white">{{ $populer->kendaraan->merk }} {{ $populer->kendaraan->model }}</div>
                                                    <small class="text-muted">{{ $populer->kendaraan->tahun }}</small>
                                                </td>
                                                <td class="text-muted">{{ $populer->kendaraan->plat_nomor }}</td>
                                                <td class="text-center text-white">{{ $populer->total_sewa }}x</td>
                                                <td class="text-center">
                                                    @if($index == 0)
                                                        <span class="badge bg-warning">#1</span>
                                                    @elseif($index == 1)
                                                        <span class="badge bg-secondary">#2</span>
                                                    @elseif($index == 2)
                                                        <span class="badge bg-danger">#3</span>
                                                    @else
                                                        <span class="badge bg-dark">#{{ $index + 1 }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-car fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada data kendaraan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Customer Teraktif -->
            <div class="col-lg-6 mb-4">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-users me-2 text-info"></i>
                            Customer Teraktif
                        </h5>
                        
                        @if($customer_teraktif->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Email</th>
                                            <th class="text-center">Total Rental</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customer_teraktif as $index => $customer)
                                            <tr>
                                                <td>
                                                    <div class="text-white">{{ $customer->user->nama_user }}</div>
                                                    <small class="text-muted">Member sejak {{ $customer->user->created_at->format('M Y') }}</small>
                                                </td>
                                                <td class="text-muted">{{ $customer->user->email }}</td>
                                                <td class="text-center text-white">{{ $customer->total_rental }}x</td>
                                                <td class="text-center">
                                                    @if($customer->total_rental >= 10)
                                                        <span class="badge bg-success">VIP</span>
                                                    @elseif($customer->total_rental >= 5)
                                                        <span class="badge bg-primary">Regular</span>
                                                    @else
                                                        <span class="badge bg-secondary">New</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada data customer</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Metode Pembayaran -->
            <div class="col-lg-6 mb-4">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-credit-card me-2 text-success"></i>
                            Metode Pembayaran
                        </h5>
                        
                        @if($metode_pembayaran->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th>Metode</th>
                                            <th class="text-center">Jumlah Transaksi</th>
                                            <th class="text-end">Total Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($metode_pembayaran as $metode)
                                            <tr>
                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ ucfirst($metode->metode_pembayaran) }}
                                                    </span>
                                                </td>
                                                <td class="text-center text-white">{{ $metode->total }}</td>
                                                <td class="text-end text-success">Rp {{ number_format($metode->total_pendapatan, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-credit-card fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada data pembayaran</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Grafik Pendapatan Sederhana -->
            <div class="col-lg-6 mb-4">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-chart-bar me-2 text-orange"></i>
                            Tren Pendapatan Tahunan {{ date('Y') }}
                        </h5>
                        
                        <div class="grafik-sederhana">
                            @php
                                $max_pendapatan = max($pendapatan_bulanan) ?: 1;
                                $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                            @endphp
                            
                            <div class="d-flex align-items-end" style="height: 200px; gap: 8px;">
                                @foreach($pendapatan_bulanan as $index => $pendapatan)
                                    @php
                                        $tinggi = $pendapatan / $max_pendapatan * 150;
                                        $warna = $pendapatan > 0 ? 'var(--orange)' : 'var(--gray)';
                                    @endphp
                                    <div class="d-flex flex-column align-items-center" style="flex: 1;">
                                        <div 
                                            class="grafik-bar rounded-top" 
                                            style="height: {{ $tinggi }}px; background: {{ $warna }}; width: 30px;"
                                            data-bs-toggle="tooltip" 
                                            title="Rp {{ number_format($pendapatan, 0, ',', '.') }}"
                                        ></div>
                                        <small class="text-muted mt-2">{{ $bulan[$index] }}</small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="mt-4 text-center">
                            <small class="text-muted">
                                Total Pendapatan Tahun {{ date('Y') }}: 
                                <strong class="text-success">Rp {{ number_format(array_sum($pendapatan_bulanan), 0, ',', '.') }}</strong>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Periode -->
        <div class="orange-card">
            <div class="card-body">
                <h5 class="card-title text-white mb-4">
                    <i class="fas fa-calendar-alt me-2 text-primary"></i>
                    Ringkasan Periode
                </h5>
                
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="border rounded p-3">
                            <div class="text-success fw-bold fs-5">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</div>
                            <small class="text-muted">Pendapatan</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3">
                            <div class="text-primary fw-bold fs-5">{{ $total_transaksi }}</div>
                            <small class="text-muted">Transaksi</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3">
                            <div class="text-warning fw-bold fs-5">{{ $kendaraan_terpopuler->count() }}</div>
                            <small class="text-muted">Kendaraan Aktif</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3">
                            <div class="text-info fw-bold fs-5">{{ $customer_teraktif->count() }}</div>
                            <small class="text-muted">Customer Aktif</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .stat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }
    
    .grafik-bar {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .grafik-bar:hover {
        opacity: 0.8;
        transform: scale(1.05);
    }
    
    .table-hover tbody tr:hover {
        background: rgba(255, 107, 53, 0.1) !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips untuk grafik
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection