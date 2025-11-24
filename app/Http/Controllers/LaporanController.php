<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Pembayaran;
use App\Models\Kendaraan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->get('periode', 'bulan_ini');
        
        $data = [
            'total_pendapatan' => $this->getTotalPendapatan($periode),
            'total_transaksi' => $this->getTotalTransaksi($periode),
            'rata_rata_sewa' => $this->getRataRataSewa($periode),
            'kendaraan_terpopuler' => $this->getKendaraanPopuler($periode),
            'customer_teraktif' => $this->getCustomerAktif($periode),
            'pendapatan_bulanan' => $this->getPendapatanBulanan(),
            'metode_pembayaran' => $this->getMetodePembayaran($periode),
            'periode' => $periode,
            'date_range' => $this->getDateRange($periode)
        ];

        return view('admin.laporan', $data);
    }

    private function getTotalPendapatan($periode)
    {
        return Pembayaran::whereBetween('created_at', $this->getDateRange($periode))
            ->sum('jumlah_bayar');
    }

    private function getTotalTransaksi($periode)
    {
        return Rental::whereBetween('created_at', $this->getDateRange($periode))
            ->count();
    }

    private function getRataRataSewa($periode)
    {
        $total = Rental::whereBetween('created_at', $this->getDateRange($periode))->count();
        $pendapatan = $this->getTotalPendapatan($periode);
        
        return $total > 0 ? $pendapatan / $total : 0;
    }

    private function getKendaraanPopuler($periode)
    {
        return Rental::whereBetween('created_at', $this->getDateRange($periode))
            ->with('kendaraan')
            ->selectRaw('id_kendaraan, count(*) as total_sewa')
            ->groupBy('id_kendaraan')
            ->orderBy('total_sewa', 'desc')
            ->limit(5)
            ->get();
    }

    private function getCustomerAktif($periode)
    {
        return Rental::whereBetween('created_at', $this->getDateRange($periode))
            ->with('user')
            ->selectRaw('id_user, count(*) as total_rental')
            ->groupBy('id_user')
            ->orderBy('total_rental', 'desc')
            ->limit(5)
            ->get();
    }

    private function getPendapatanBulanan()
    {
        $pendapatan = [];
        for ($i = 1; $i <= 12; $i++) {
            $pendapatan[] = Pembayaran::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->sum('jumlah_bayar');
        }
        return $pendapatan;
    }

    private function getMetodePembayaran($periode)
    {
        return Pembayaran::whereBetween('created_at', $this->getDateRange($periode))
            ->selectRaw('metode_pembayaran, count(*) as total, sum(jumlah_bayar) as total_pendapatan')
            ->groupBy('metode_pembayaran')
            ->get();
    }

    private function getDateRange($periode)
    {
        switch ($periode) {
            case 'hari_ini':
                return [Carbon::today(), Carbon::tomorrow()];
            case 'minggu_ini':
                return [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
            case 'bulan_ini':
                return [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()];
            case 'tahun_ini':
                return [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()];
            case 'semua':
                return [Carbon::create(2020, 1, 1), Carbon::now()->endOfDay()];
            default:
                return [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()];
        }
    }

    public function export(Request $request)
    {
        // Untuk export PDF/Excel (bisa dikembangkan nanti)
        return redirect()->route('admin.laporan')
            ->with('success', 'Fitur export akan segera tersedia!');
    }

    public function ownerIndex(Request $request)
    {
        // Ambil periode dari request atau set default
        $periode = $request->input('periode', 'bulan_ini');
        
        // Set tanggal berdasarkan periode
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));
    
        $rentals = Rental::with(['user', 'kendaraan', 'pembayaran'])
            ->whereBetween('created_at', [$startDate, Carbon::parse($endDate)->endOfDay()])
            ->orderBy('created_at', 'desc')
            ->get();
    
        $totalPendapatan = Pembayaran::whereBetween('created_at', [$startDate, Carbon::parse($endDate)->endOfDay()])
            ->sum('jumlah_bayar');
    
        // Data dasar untuk view
        $total_transaksi = $rentals->count();
        $rata_rata_sewa = $total_transaksi > 0 ? $totalPendapatan / $total_transaksi : 0;
    
        return view('owner.laporan', compact(
            'rentals', 
            'totalPendapatan', 
            'startDate', 
            'endDate',
            'periode',
            'total_transaksi',
            'rata_rata_sewa'
        ));
    }
}