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
            
        $users = User::where('role', 'user')->get();
        $kendaraans = Kendaraan::where('status', 'tersedia')->get();
        
        $editRental = null;
        if ($request->has('edit')) {
            $editRental = Rental::with(['user', 'kendaraan'])->find($request->edit);
        }

        // Hitung jumlah rental aktif untuk badge
        $rental_aktif = Rental::whereIn('status_sewa', ['berlangsung', 'pending'])->count();

        return view('admin.rental', compact('rentals', 'users', 'kendaraans', 'editRental', 'rental_aktif'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_kendaraan' => 'required|exists:kendaraan,id_kendaraan',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status_sewa' => 'required|in:pending,berlangsung,selesai,dibatalkan'
        ]);

        // Cek ketersediaan kendaraan
        $existingRental = Rental::where('id_kendaraan', $request->id_kendaraan)
            ->whereIn('status_sewa', ['pending', 'berlangsung'])
            ->where(function($query) use ($request) {
                $query->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                      ->orWhereBetween('tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                      ->orWhere(function($q) use ($request) {
                          $q->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                            ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
                      });
            })
            ->first();

        if ($existingRental) {
            return redirect()->route('admin.rental')
                ->with('error', 'Kendaraan tidak tersedia pada tanggal yang dipilih!');
        }

        // Hitung total harga
        $start = Carbon::parse($request->tanggal_mulai);
        $end = Carbon::parse($request->tanggal_selesai);
        $days = $start->diffInDays($end) + 1; // Termasuk hari pertama

        // Ambil harga terbaru untuk kendaraan
        $harga = Harga::where('id_kendaraan', $request->id_kendaraan)
            ->where('tanggal_berlaku', '<=', $request->tanggal_mulai)
            ->orderBy('tanggal_berlaku', 'desc')
            ->first();

        if (!$harga) {
            return redirect()->route('admin.rental')
                ->with('error', 'Harga untuk kendaraan ini belum ditetapkan!');
        }

        $total_harga = $days * $harga->harga_perhari;

        // Simpan data rental
        $rentalData = $request->all();
        $rentalData['total_harga'] = $total_harga;

        Rental::create($rentalData);

        return redirect()->route('admin.rental')
            ->with('success', 'Rental berhasil ditambahkan!');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'id_kendaraan' => 'required|exists:kendaraan,id_kendaraan',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status_sewa' => 'required|in:pending,berlangsung,selesai,dibatalkan'
        ]);

        $rental = Rental::findOrFail($id);

        // Cek ketersediaan kendaraan (kecuali untuk rental ini sendiri)
        $existingRental = Rental::where('id_kendaraan', $request->id_kendaraan)
            ->where('id_rental', '!=', $id)
            ->whereIn('status_sewa', ['pending', 'berlangsung'])
            ->where(function($query) use ($request) {
                $query->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                      ->orWhereBetween('tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                      ->orWhere(function($q) use ($request) {
                          $q->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                            ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
                      });
            })
            ->first();

        if ($existingRental) {
            return redirect()->route('admin.rental')
                ->with('error', 'Kendaraan tidak tersedia pada tanggal yang dipilih!');
        }

        // Hitung ulang total harga jika tanggal berubah
        if ($request->tanggal_mulai != $rental->tanggal_mulai || $request->tanggal_selesai != $rental->tanggal_selesai) {
            $start = Carbon::parse($request->tanggal_mulai);
            $end = Carbon::parse($request->tanggal_selesai);
            $days = $start->diffInDays($end) + 1;

            $harga = Harga::where('id_kendaraan', $request->id_kendaraan)
                ->where('tanggal_berlaku', '<=', $request->tanggal_mulai)
                ->orderBy('tanggal_berlaku', 'desc')
                ->first();

            if (!$harga) {
                return redirect()->route('admin.rental')
                    ->with('error', 'Harga untuk kendaraan ini belum ditetapkan!');
            }

            $total_harga = $days * $harga->harga_perhari;
            $rental->total_harga = $total_harga;
        }

        $rental->update($request->except('total_harga'));

        return redirect()->route('admin.rental')
            ->with('success', 'Rental berhasil diupdate!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_sewa' => 'required|in:pending,berlangsung,selesai,dibatalkan'
        ]);

        $rental = Rental::findOrFail($id);
        $oldStatus = $rental->status_sewa;
        $rental->update(['status_sewa' => $request->status_sewa]);

        // Update status kendaraan jika perlu
        if ($request->status_sewa == 'berlangsung') {
            $rental->kendaraan()->update(['status' => 'disewa']);
        } elseif ($oldStatus == 'berlangsung' && in_array($request->status_sewa, ['selesai', 'dibatalkan'])) {
            $rental->kendaraan()->update(['status' => 'tersedia']);
        }

        return redirect()->route('admin.rental')
            ->with('success', 'Status rental berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);
        
        // Kembalikan status kendaraan jika rental aktif dihapus
        if ($rental->status_sewa == 'berlangsung') {
            $rental->kendaraan()->update(['status' => 'tersedia']);
        }
        
        $rental->delete();

        return redirect()->route('admin.rental')
            ->with('success', 'Rental berhasil dihapus!');
    }
}