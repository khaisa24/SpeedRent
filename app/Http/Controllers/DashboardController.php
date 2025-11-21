<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Rental;
use App\Models\Harga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return $this->adminDashboard();
        }

        return $this->userDashboard();
    }

    public function adminDashboard()
    {
        // Statistics untuk admin
        $total_kendaraan = Kendaraan::count();
        $rental_aktif = Rental::whereIn('status_sewa', ['pending', 'berlangsung'])->count();
        $pending_requests = Rental::where('status_sewa', 'pending')->count();
        
        // Recent rentals
        $recent_rentals = Rental::with(['user', 'kendaraan'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Available vehicles - tanpa kondisi status dan stok
        $available_vehicles = Harga::with('kendaraan')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'total_kendaraan',
            'rental_aktif', 
            'pending_requests',
            'recent_rentals',
            'available_vehicles'
        ));
    }

    private function userDashboard()
    {
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
    }
}