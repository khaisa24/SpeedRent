@extends('layouts.app')

@section('title', 'Data Pembayaran - SpeedRent')

@section('content')
<div class="dashboard-container">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-white mb-0"><i class="fas fa-credit-card me-2"></i>Data Pembayaran</h2>
                    <div class="d-flex">
                        <span class="badge bg-info me-2 p-2">
                            <i class="fas fa-money-bill-wave me-1"></i>
                            Total: Rp {{ number_format($totalPembayaran, 0, ',', '.') }}
                        </span>
                        <span class="badge bg-warning p-2">
                            <i class="fas fa-clock me-1"></i>
                            Pending: {{ $pendingCount }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Data Pembayaran Card -->
        <div class="orange-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark table-hover" id="table-pembayaran">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>ID Rental</th>
                                <th>User</th>
                                <th>Metode Bayar</th>
                                <th>Jumlah Bayar</th>
                                <th>Bukti Bayar</th>
                                <th>Tanggal Bayar</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pembayaran as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-secondary">#{{ $item->id_rental }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                            {{ strtoupper(substr($item->user->nama_user ?? 'N/A', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="small text-white">{{ $item->user->nama_user ?? 'N/A' }}</div>
                                            <div class="small text-muted">{{ $item->user->email ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $item->metode_pembayaran == 'transfer' ? 'success' : 'primary' }}">
                                        <i class="fas fa-{{ $item->metode_pembayaran == 'transfer' ? 'university' : 'money-bill-wave' }} me-1"></i>
                                        {{ strtoupper($item->metode_pembayaran) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-success fw-bold">
                                        Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->bukti_bayar)
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#buktiModal{{ $item->id_pembayaran }}">
                                            <i class="fas fa-eye me-1"></i>Lihat Bukti
                                        </button>
                                    @else
                                        <span class="text-muted"><i class="fas fa-times me-1"></i>Tidak ada</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $item->created_at->format('d/m/Y H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->id_pembayaran }}" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.pembayaran.edit', $item->id_pembayaran) }}" class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.pembayaran.destroy', $item->id_pembayaran) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus data pembayaran?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Modal Detail -->
                                    <div class="modal fade" id="modalDetail{{ $item->id_pembayaran }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content orange-card">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-white">
                                                        <i class="fas fa-receipt me-2"></i>Detail Pembayaran
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">ID Pembayaran</label>
                                                            <div class="text-white p-2 bg-dark rounded">#{{ $item->id_pembayaran }}</div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">ID Rental</label>
                                                            <div class="text-white p-2 bg-dark rounded">#{{ $item->id_rental }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">User</label>
                                                            <div class="text-white p-2 bg-dark rounded">
                                                                <i class="fas fa-user me-2"></i>{{ $item->user->nama_user ?? 'N/A' }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Email</label>
                                                            <div class="text-white p-2 bg-dark rounded">
                                                                <i class="fas fa-envelope me-2"></i>{{ $item->user->email ?? 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Metode Pembayaran</label>
                                                            <div class="p-2 bg-dark rounded">
                                                                <span class="badge bg-{{ $item->metode_pembayaran == 'transfer' ? 'success' : 'primary' }}">
                                                                    <i class="fas fa-{{ $item->metode_pembayaran == 'transfer' ? 'university' : 'money-bill-wave' }} me-1"></i>
                                                                    {{ strtoupper($item->metode_pembayaran) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Jumlah Bayar</label>
                                                            <div class="text-success fw-bold p-2 bg-dark rounded">
                                                                <i class="fas fa-money-bill-wave me-2"></i>
                                                                Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Tanggal Pembayaran</label>
                                                            <div class="text-white p-2 bg-dark rounded">
                                                                <i class="fas fa-calendar me-2"></i>
                                                                {{ $item->created_at->format('d F Y H:i:s') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-orange-outline" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Bukti Bayar -->
                                    @if($item->bukti_bayar)
                                    <div class="modal fade" id="buktiModal{{ $item->id_pembayaran }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content orange-card">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-white">
                                                        <i class="fas fa-image me-2"></i>Bukti Pembayaran
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $item->bukti_bayar) }}" 
                                                         alt="Bukti Bayar" 
                                                         class="img-fluid rounded" 
                                                         style="max-height: 500px;">
                                                    <div class="mt-3">
                                                        <a href="{{ asset('storage/' . $item->bukti_bayar) }}" 
                                                           download 
                                                           class="btn btn-orange-primary">
                                                            <i class="fas fa-download me-1"></i>Download Bukti
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-credit-card fa-3x mb-3"></i>
                                        <h5>Tidak ada data pembayaran</h5>
                                        <p>Belum ada transaksi pembayaran yang tercatat</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($pembayaran->hasPages())
                <div class="mt-4">
                    {{ $pembayaran->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Auto-close alerts setelah 5 detik
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endsection