@extends('layouts.owner')

@section('title', 'Laporan - SpeedRent Owner')

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
                                <option value="hari_ini" {{ ($periode ?? 'bulan_ini') == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                                <option value="minggu_ini" {{ ($periode ?? 'bulan_ini') == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                                <option value="bulan_ini" {{ ($periode ?? 'bulan_ini') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                                <option value="tahun_ini" {{ ($periode ?? 'bulan_ini') == 'tahun_ini' ? 'selected' : '' }}>Tahun Ini</option>
                                <option value="semua" {{ ($periode ?? 'bulan_ini') == 'semua' ? 'selected' : '' }}>Semua Waktu</option>
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

        <!-- Ringkasan Periode -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="orange-card">
                    <div class="card-body py-3">
                        <div class="row text-center">
                            <div class="col-md-3 border-end">
                                <div class="text-success fw-bold fs-4">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
                                <small class="text-muted">Total Pendapatan</small>
                                <div class="mt-1">
                                    <small class="text-muted">Periode: {{ ucfirst(str_replace('_', ' ', $periode ?? 'bulan_ini')) }}</small>
                                </div>
                            </div>
                            <div class="col-md-3 border-end">
                                <div class="text-primary fw-bold fs-4">{{ $total_transaksi ?? 0 }}</div>
                                <small class="text-muted">Total Transaksi</small>
                            </div>
                            <div class="col-md-3 border-end">
                                <div class="text-warning fw-bold fs-4">Rp {{ number_format($rata_rata_sewa ?? 0, 0, ',', '.') }}</div>
                                <small class="text-muted">Rata-rata per Rental</small>
                            </div>
                            <div class="col-md-3">
                                <div class="text-info fw-bold fs-4">{{ ($kendaraan_terpopuler ?? collect())->count() }}</div>
                                <small class="text-muted">Kendaraan Aktif</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Kendaraan Terpopuler -->
            <div class="col-lg-6 mb-4">
                <div class="orange-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-3">
                            <i class="fas fa-crown me-2 text-warning"></i>
                            Kendaraan Terpopuler
                        </h5>
                        
                        @if(($kendaraan_terpopuler ?? collect())->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-dark table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>Kendaraan</th>
                                            <th class="text-center">Sewa</th>
                                            <th class="text-center">Rank</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kendaraan_terpopuler as $index => $populer)
                                            <tr>
                                                <td>
                                                    <div class="text-white small">{{ $populer->kendaraan->nama_mobil ?? 'N/A' }}</div>
                                                    <small class="text-muted">{{ $populer->kendaraan->merk ?? 'N/A' }}</small>
                                                </td>
                                                <td class="text-center text-white">{{ $populer->total_sewa ?? 0 }}x</td>
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
                            <div class="text-center py-3">
                                <i class="fas fa-car fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0 small">Belum ada data kendaraan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Customer Teraktif -->
            <div class="col-lg-6 mb-4">
                <div class="orange-card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-3">
                            <i class="fas fa-users me-2 text-info"></i>
                            Customer Teraktif
                        </h5>
                        
                        @if(($customer_teraktif ?? collect())->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-dark table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th class="text-center">Rental</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customer_teraktif as $index => $customer)
                                            <tr>
                                                <td>
                                                    <div class="text-white small">{{ $customer->user->nama_user ?? 'N/A' }}</div>
                                                    <small class="text-muted">{{ $customer->user->email ?? 'N/A' }}</small>
                                                </td>
                                                <td class="text-center text-white">{{ $customer->total_rental ?? 0 }}x</td>
                                                <td class="text-center">
                                                    @if(($customer->total_rental ?? 0) >= 10)
                                                        <span class="badge bg-success">VIP</span>
                                                    @elseif(($customer->total_rental ?? 0) >= 5)
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
                            <div class="text-center py-3">
                                <i class="fas fa-users fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0 small">Belum ada data customer</p>
                            </div>
                        @endif
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
    
    .table-hover tbody tr:hover {
        background: rgba(255, 107, 53, 0.1) !important;
    }
    
    .border-end {
        border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
    }
    
    .orange-card {
        border: 1px solid rgba(255, 107, 53, 0.2);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips jika ada
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection