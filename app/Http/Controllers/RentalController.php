<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Harga;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $rentals = Rental::with(['user', 'kendaraan'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Hitung jumlah rental aktif untuk badge
        $rental_aktif = Rental::whereIn('status_sewa', ['berlangsung', 'pending'])->count();

        return view('admin.rental', compact('rentals', 'rental_aktif'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_sewa' => 'required|in:pending,berlangsung,selesai,dibatalkan'
        ]);

        $rental = Rental::findOrFail($id);
        $oldStatus = $rental->status_sewa;
        $rental->update(['status_sewa' => $request->status_sewa]);

        // Update status kendaraan berdasarkan status rental
        $kendaraan = $rental->kendaraan;
        
        if ($request->status_sewa == 'berlangsung') {
            $kendaraan->update(['status' => 'Disewa']);
        } elseif ($oldStatus == 'berlangsung' && in_array($request->status_sewa, ['selesai', 'dibatalkan'])) {
            $kendaraan->update(['status' => 'Tersedia']);
        } elseif ($request->status_sewa == 'pending') {
            // Untuk status pending, kendaraan tetap tersedia
            $kendaraan->update(['status' => 'Tersedia']);
        } elseif ($request->status_sewa == 'selesai') {
            $kendaraan->update(['status' => 'Tersedia']);
        } elseif ($request->status_sewa == 'dibatalkan') {
            $kendaraan->update(['status' => 'Tersedia']);
        }

        return redirect()->route('admin.rental')
            ->with('success', 'Status rental berhasil diupdate!');
    }
}