<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $pembayarans = Pembayaran::with(['rental.kendaraan', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Ambil semua rental yang belum memiliki pembayaran
        $rentals = Rental::whereIn('status_sewa', ['pending', 'berlangsung'])
            ->whereDoesntHave('pembayaran')
            ->with(['user', 'kendaraan'])
            ->get();
        
        $editPembayaran = null;
        if ($request->has('edit')) {
            $editPembayaran = Pembayaran::with(['rental', 'user'])->find($request->edit);
        }

        // Hitung statistik berdasarkan keberadaan pembayaran
        $total_pendapatan = Pembayaran::sum('jumlah_bayar');
        $pending_payments = Rental::whereIn('status_sewa', ['pending', 'berlangsung'])
            ->whereDoesntHave('pembayaran')
            ->count();

        return view('admin.pembayaran', compact('pembayarans', 'rentals', 'editPembayaran', 'total_pendapatan', 'pending_payments'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_rental' => 'required|exists:rental,id_rental',
            'metode_pembayaran' => 'required|in:transfer,bank,cash,qris',
            'jumlah_bayar' => 'required|numeric|min:0',
            'bukti_bayar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Cek apakah rental sudah memiliki pembayaran
        $existingPayment = Pembayaran::where('id_rental', $request->id_rental)->first();

        if ($existingPayment) {
            return redirect()->route('admin.pembayaran')
                ->with('error', 'Rental ini sudah memiliki pembayaran!');
        }

        $pembayaranData = $request->all();
        
        // Handle file upload
        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/bukti_bayar', $filename);
            $pembayaranData['bukti_bayar'] = $filename;
        }

        // Ambil id_user dari rental
        $rental = Rental::find($request->id_rental);
        $pembayaranData['id_user'] = $rental->id_user;

        Pembayaran::create($pembayaranData);

        // Update status rental menjadi berlangsung setelah pembayaran
        $rental->update(['status_sewa' => 'berlangsung']);

        return redirect()->route('admin.pembayaran')
            ->with('success', 'Pembayaran berhasil ditambahkan!');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_rental' => 'required|exists:rental,id_rental',
            'metode_pembayaran' => 'required|in:transfer,bank,cash,qris',
            'jumlah_bayar' => 'required|numeric|min:0',
            'bukti_bayar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        // Cek apakah rental sudah memiliki pembayaran lain
        $existingPayment = Pembayaran::where('id_rental', $request->id_rental)
            ->where('id_pembayaran', '!=', $id)
            ->first();

        if ($existingPayment) {
            return redirect()->route('admin.pembayaran')
                ->with('error', 'Rental ini sudah memiliki pembayaran!');
        }

        $pembayaranData = $request->all();
        
        // Handle file upload
        if ($request->hasFile('bukti_bayar')) {
            // Hapus file lama jika ada
            if ($pembayaran->bukti_bayar) {
                Storage::delete('public/bukti_bayar/' . $pembayaran->bukti_bayar);
            }
            
            $file = $request->file('bukti_bayar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/bukti_bayar', $filename);
            $pembayaranData['bukti_bayar'] = $filename;
        }

        $pembayaran->update($pembayaranData);

        return redirect()->route('admin.pembayaran')
            ->with('success', 'Pembayaran berhasil diupdate!');
    }

    public function showBukti($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
        if (!$pembayaran->bukti_bayar) {
            abort(404);
        }

        $path = storage_path('app/public/bukti_bayar/' . $pembayaran->bukti_bayar);
        
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
    
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
        // Hapus file bukti bayar jika ada
        if ($pembayaran->bukti_bayar) {
            Storage::delete('public/bukti_bayar/' . $pembayaran->bukti_bayar);
        }
        
        $pembayaran->delete();

        return redirect()->route('admin.pembayaran')
            ->with('success', 'Pembayaran berhasil dihapus!');
    }
}