@extends('layouts.app')

@section('title', 'Manajemen Rental - SpeedRent')

@section('content')
<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="text-white mb-1">Manajemen Rental</h2>
                        <p class="text-muted mb-0">Kelola penyewaan kendaraan di SpeedRent</p>
                    </div>
                    <div class="badge bg-primary fs-6">
                        <i class="fas fa-sync-alt me-1"></i>
                        {{ $rental_aktif }} Rental Aktif
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
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

        <div class="row">
            <!-- Form Input Rental -->
            <div class="col-lg-4 mb-4">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-plus-circle me-2 text-orange"></i>
                            {{ isset($editRental) ? 'Edit Rental' : 'Tambah Rental Baru' }}
                        </h5>
                        
                        <form action="{{ isset($editRental) ? route('admin.rental.update', $editRental->id_rental) : route('admin.rental.store') }}" method="POST">
                            @csrf
                            @if(isset($editRental))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="id_user" class="form-label">Customer</label>
                                <select class="form-control" id="id_user" name="id_user" required>
                                    <option value="">Pilih Customer</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id_user }}" 
                                            {{ old('id_user', $editRental->id_user ?? '') == $user->id_user ? 'selected' : '' }}>
                                            {{ $user->nama_user }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_user')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="id_kendaraan" class="form-label">Kendaraan</label>
                                <select class="form-control" id="id_kendaraan" name="id_kendaraan" required>
                                    <option value="">Pilih Kendaraan</option>
                                    @foreach($kendaraans as $kendaraan)
                                        <option value="{{ $kendaraan->id_kendaraan }}" 
                                            {{ old('id_kendaraan', $editRental->id_kendaraan ?? '') == $kendaraan->id_kendaraan ? 'selected' : '' }}
                                            data-harga="{{ $kendaraan->harga_perhari ?? 0 }}">
                                            {{ $kendaraan->merk }} {{ $kendaraan->model }} - {{ $kendaraan->plat_nomor }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kendaraan')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" 
                                               value="{{ old('tanggal_mulai', isset($editRental) ? $editRental->tanggal_mulai->format('Y-m-d') : '') }}" 
                                               required>
                                        @error('tanggal_mulai')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" 
                                               value="{{ old('tanggal_selesai', isset($editRental) ? $editRental->tanggal_selesai->format('Y-m-d') : '') }}" 
                                               required>
                                        @error('tanggal_selesai')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="status_sewa" class="form-label">Status Sewa</label>
                                <select class="form-control" id="status_sewa" name="status_sewa" required>
                                    <option value="pending" {{ old('status_sewa', $editRental->status_sewa ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="berlangsung" {{ old('status_sewa', $editRental->status_sewa ?? '') == 'berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                                    <option value="selesai" {{ old('status_sewa', $editRental->status_sewa ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ old('status_sewa', $editRental->status_sewa ?? '') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                @error('status_sewa')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            @if(isset($editRental))
                                <div class="mb-3 p-3 bg-dark rounded">
                                    <small class="text-muted">Total Harga</small>
                                    <div class="text-orange fw-bold fs-5">
                                        Rp {{ number_format($editRental->total_harga, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endif

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-orange-primary">
                                    <i class="fas fa-save me-2"></i>
                                    {{ isset($editRental) ? 'Update Rental' : 'Simpan Rental' }}
                                </button>
                                
                                @if(isset($editRental))
                                    <a href="{{ route('admin.rental') }}" class="btn btn-orange-outline">
                                        <i class="fas fa-times me-2"></i>Batal Edit
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Daftar Rental -->
            <div class="col-lg-8">
                <div class="orange-card">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">
                            <i class="fas fa-list me-2 text-orange"></i>
                            Daftar Rental
                        </h5>

                        @if($rentals->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th>Customer</th>
                                            <th>Kendaraan</th>
                                            <th>Periode</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th width="150" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rentals as $index => $rental)
                                            <tr>
                                                <td class="text-muted">{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="text-white">{{ $rental->user->nama_user }}</div>
                                                    <small class="text-muted">{{ $rental->user->email }}</small>
                                                </td>
                                                <td>
                                                    <div class="text-white">{{ $rental->kendaraan->merk }} {{ $rental->kendaraan->model }}</div>
                                                    <small class="text-muted">{{ $rental->kendaraan->plat_nomor }}</small>
                                                </td>
                                                <td class="text-muted">
                                                    <div>{{ $rental->tanggal_mulai->format('d/m/Y') }}</div>
                                                    <small>s/d {{ $rental->tanggal_selesai->format('d/m/Y') }}</small>
                                                </td>
                                                <td class="text-white">
                                                    Rp {{ number_format($rental->total_harga, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    @php
                                                        $statusClass = [
                                                            'pending' => 'bg-warning',
                                                            'berlangsung' => 'bg-primary',
                                                            'selesai' => 'bg-success',
                                                            'dibatalkan' => 'bg-danger'
                                                        ][$rental->status_sewa];
                                                    @endphp
                                                    <span class="badge {{ $statusClass }}">
                                                        {{ ucfirst($rental->status_sewa) }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('admin.rental', ['edit' => $rental->id_rental]) }}" 
                                                           class="btn btn-orange-outline" 
                                                           data-bs-toggle="tooltip" 
                                                           title="Edit Rental">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        
                                                        <!-- Quick Status Update -->
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-orange-outline dropdown-toggle" data-bs-toggle="dropdown" title="Ubah Status">
                                                                <i class="fas fa-sync-alt"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                @foreach(['pending', 'berlangsung', 'selesai', 'dibatalkan'] as $status)
                                                                    @if($status != $rental->status_sewa)
                                                                        <li>
                                                                            <form action="{{ route('admin.rental.updateStatus', $rental->id_rental) }}" method="POST" class="d-inline">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="hidden" name="status_sewa" value="{{ $status }}">
                                                                                <button type="submit" class="dropdown-item">
                                                                                    Set {{ ucfirst($status) }}
                                                                                </button>
                                                                            </form>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                        <form action="{{ route('admin.rental.destroy', $rental->id_rental) }}" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus rental ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="btn btn-orange-outline" 
                                                                    data-bs-toggle="tooltip" 
                                                                    title="Hapus Rental">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada data rental</h5>
                                <p class="text-muted">Mulai dengan menambahkan rental pertama Anda</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background: rgba(255, 107, 53, 0.1) !important;
    }
    
    .btn-group-sm > .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    
    .card-title {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 1rem;
    }
    
    .dropdown-menu {
        background: rgba(26, 26, 26, 0.95);
        border: 1px solid rgba(255, 107, 53, 0.3);
    }
    
    .dropdown-item {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .dropdown-item:hover {
        background: rgba(255, 107, 53, 0.2);
        color: var(--white);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto scroll to form when editing
        @if(isset($editRental))
            document.querySelector('.orange-card').scrollIntoView({
                behavior: 'smooth'
            });
        @endif

        // Set default tanggal untuk form baru
        @if(!isset($editRental))
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_mulai').value = today;
            
            // Set tanggal selesai default 1 hari setelah mulai
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            document.getElementById('tanggal_selesai').value = tomorrow.toISOString().split('T')[0];
        @endif

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection