<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Rental;
use App\Models\Harga;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        Log::info('Dashboard accessed by user: ' . $user->email . ' with role: ' . $user->role);

        if ($user->role === 'admin') {
            return $this->adminDashboard();
        } elseif ($user->role === 'owner') {
            return $this->ownerDashboard();
        }

        return $this->userDashboard();
    }

    public function adminDashboard()
    {
        try {
            // Statistics untuk admin
            $total_kendaraan = Kendaraan::count();
            $rental_aktif = Rental::whereIn('status_sewa', ['pending', 'berlangsung'])->count();
            $pending_requests = Rental::where('status_sewa', 'pending')->count();
            
            // Recent rentals
            $recent_rentals = Rental::with(['user', 'kendaraan'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            // Available vehicles
            $available_vehicles = Harga::with('kendaraan')
                ->limit(5)
                ->get();

            Log::info('Admin dashboard loaded successfully');

            return view('admin.dashboard', compact(
                'total_kendaraan',
                'rental_aktif', 
                'pending_requests',
                'recent_rentals',
                'available_vehicles'
            ));
        } catch (\Exception $e) {
            Log::error('Error in adminDashboard: ' . $e->getMessage());
            return response()->view('errors.500', [], 500);
        }
    }

    public function ownerDashboard()
    {
        try {
            Log::info('Loading owner dashboard...');

            // Statistics untuk owner
            $total_kendaraan = Kendaraan::count();
            $total_users = User::where('role', 'user')->count();
            $total_admin = User::where('role', 'admin')->count();
            
            $rental_aktif = Rental::whereIn('status_sewa', ['pending', 'berlangsung'])->count();
            $pending_requests = Rental::where('status_sewa', 'pending')->count();
            $rental_selesai = Rental::where('status_sewa', 'selesai')->count();
            
            // Pendapatan bulan ini - dengan error handling
            $pendapatan_bulan_ini = 0;
            try {
                $pendapatan_bulan_ini = Pembayaran::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->sum('jumlah_bayar');
            } catch (\Exception $e) {
                Log::warning('Error calculating income: ' . $e->getMessage());
            }

            // Recent rentals
            $recent_rentals = Rental::with(['user', 'kendaraan'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            // Available vehicles
            $available_vehicles = Harga::with('kendaraan')->limit(5)->get();

            Log::info('Owner dashboard data loaded successfully');

            return view('owner.dashboard', compact(
                'total_kendaraan',
                'total_users',
                'total_admin',
                'rental_aktif', 
                'pending_requests',
                'rental_selesai',
                'pendapatan_bulan_ini',
                'recent_rentals',
                'available_vehicles'
            ));

        } catch (\Exception $e) {
            Log::error('Error in ownerDashboard: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->view('errors.500', ['error' => $e->getMessage()], 500);
        }
    }

    private function userDashboard()
    {
        try {
            $user = Auth::user();

            // Statistics untuk user
            $total_rental_saya = Rental::where('id_user', $user->id_user)->count();
            $rental_berjalan = Rental::where('id_user', $user->id_user)
                ->where('status_sewa', 'berlangsung')
                ->count();
            $rental_selesai = Rental::where('id_user', $user->id_user)
                ->where('status_sewa', 'selesai')
                ->count();
            $rental_pending = Rental::where('id_user', $user->id_user)
                ->where('status_sewa', 'pending')
                ->count();

            // Recent rentals user
            $my_recent_rentals = Rental::with('kendaraan')
                ->where('id_user', $user->id_user)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            return view('dashboard', compact(
                'total_rental_saya',
                'rental_berjalan',
                'rental_selesai', 
                'rental_pending',
                'my_recent_rentals'
            ));
        } catch (\Exception $e) {
            Log::error('Error in userDashboard: ' . $e->getMessage());
            return response()->view('errors.500', [], 500);
        }
    }
}