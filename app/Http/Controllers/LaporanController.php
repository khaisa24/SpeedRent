<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Rental;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->get('periode', 'bulan_ini');
        
        // Tentukan date range berdasarkan periode
        switch ($periode) {
            case 'hari_ini':
                $startDate = Carbon::today();
                $endDate = Carbon::today()->endOfDay();
                break;
            case 'minggu_ini':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                break;
            case 'tahun_ini':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            case 'semua':
                $startDate = Carbon::create(2000); // Tanggal sangat awal
                $endDate = Carbon::now()->endOfYear();
                break;
            default: // bulan_ini
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
        }

        // Data statistik utama
        $total_pendapatan = Pembayaran::whereBetween('created_at', [$startDate, $endDate])
            ->sum('jumlah_bayar');
            
        $total_transaksi = Rental::whereBetween('created_at', [$startDate, $endDate])
            ->count();
            
        $rata_rata_sewa = $total_transaksi > 0 ? $total_pendapatan / $total_transaksi : 0;

        // DATA BARU YANG DIPERLUKAN
        $kendaraan_tersedia = Kendaraan::where('status', 'Tersedia')->count();
        
        $status_kendaraan = Kendaraan::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();
            
        $rental_terbaru = Rental::with(['user', 'kendaraan'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Data existing (tetap pertahankan)
        $kendaraan_terpopuler = Rental::selectRaw('id_kendaraan, COUNT(*) as total_sewa')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('id_kendaraan')
            ->orderBy('total_sewa', 'desc')
            ->limit(5)
            ->with('kendaraan')
            ->get();

        $customer_teraktif = Rental::selectRaw('id_user, COUNT(*) as total_rental, SUM(total_harga) as total_belanja')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('id_user')
            ->orderBy('total_rental', 'desc')
            ->limit(5)
            ->with('user')
            ->get();

        // Data untuk grafik (opsional - bisa dihapus jika tidak digunakan)
        $pendapatan_bulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $pendapatan_bulanan[] = Pembayaran::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->sum('jumlah_bayar');
        }

        $metode_pembayaran = Pembayaran::selectRaw('metode_pembayaran, COUNT(*) as total, SUM(jumlah_bayar) as total_pendapatan')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('metode_pembayaran')
            ->get();

        return view('admin.laporan', compact(
            'total_pendapatan',
            'total_transaksi', 
            'rata_rata_sewa',
            'kendaraan_tersedia',
            'status_kendaraan',
            'rental_terbaru',
            'kendaraan_terpopuler',
            'customer_teraktif',
            'pendapatan_bulanan',
            'metode_pembayaran',
            'periode',
            'startDate',
            'endDate'
        ));
    }

    // === TAMBAHKAN METHOD INI UNTUK OWNER ===
    public function ownerIndex(Request $request)
    {
        $periode = $request->get('periode', 'bulan_ini');
        
        // Tentukan date range berdasarkan periode
        switch ($periode) {
            case 'hari_ini':
                $startDate = Carbon::today();
                $endDate = Carbon::today()->endOfDay();
                break;
            case 'minggu_ini':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                break;
            case 'tahun_ini':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            case 'semua':
                $startDate = Carbon::create(2000);
                $endDate = Carbon::now()->endOfYear();
                break;
            default: // bulan_ini
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
        }

        // Data statistik untuk owner
        $total_pendapatan = Pembayaran::whereBetween('created_at', [$startDate, $endDate])
            ->sum('jumlah_bayar');
            
        $total_transaksi = Rental::whereBetween('created_at', [$startDate, $endDate])
            ->count();
            
        $rata_rata_sewa = $total_transaksi > 0 ? $total_pendapatan / $total_transaksi : 0;

        // Data kendaraan
        $total_kendaraan = Kendaraan::count();
        $kendaraan_tersedia = Kendaraan::where('status', 'Tersedia')->count();
        $kendaraan_disewa = Kendaraan::where('status', 'Disewa')->count();
        
        $status_kendaraan = Kendaraan::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();
            
        $rental_terbaru = Rental::with(['user', 'kendaraan'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Kendaraan terpopuler
        $kendaraan_terpopuler = Rental::selectRaw('id_kendaraan, COUNT(*) as total_sewa')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('id_kendaraan')
            ->orderBy('total_sewa', 'desc')
            ->limit(5)
            ->with('kendaraan')
            ->get();

        // Customer teraktif
        $customer_teraktif = Rental::selectRaw('id_user, COUNT(*) as total_rental, SUM(total_harga) as total_belanja')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('id_user')
            ->orderBy('total_rental', 'desc')
            ->limit(5)
            ->with('user')
            ->get();

        // Data untuk charts
        $pendapatan_bulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $pendapatan_bulanan[] = Pembayaran::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->sum('jumlah_bayar');
        }

        $metode_pembayaran = Pembayaran::selectRaw('metode_pembayaran, COUNT(*) as total, SUM(jumlah_bayar) as total_pendapatan')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('metode_pembayaran')
            ->get();

        return view('owner.laporan', compact(
            'total_pendapatan',
            'total_transaksi', 
            'rata_rata_sewa',
            'total_kendaraan',
            'kendaraan_tersedia',
            'kendaraan_disewa',
            'status_kendaraan',
            'rental_terbaru',
            'kendaraan_terpopuler',
            'customer_teraktif',
            'pendapatan_bulanan',
            'metode_pembayaran',
            'periode',
            'startDate',
            'endDate'
        ));
    }

    public function export(Request $request)
    {
        // Logic untuk export laporan (opsional)
        return response()->download('path/to/exported/file.pdf');
    }
}