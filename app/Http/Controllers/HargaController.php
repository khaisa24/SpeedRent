<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HargaController extends Controller
{
    public function index(Request $request)
    {
        $hargas = Harga::with('kendaraan')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $kendaraans = Kendaraan::all();
        
        $editHarga = null;
        if ($request->has('edit')) {
            $editHarga = Harga::with('kendaraan')->find($request->edit);
        }

        return view('admin.harga', compact('hargas', 'kendaraans', 'editHarga'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_kendaraan' => 'required|exists:kendaraan,id_kendaraan',
            'harga_perhari' => 'required|numeric|min:0'
        ]);

        // Cek apakah sudah ada harga untuk kendaraan ini
        $existingHarga = Harga::where('id_kendaraan', $request->id_kendaraan)->first();

        if ($existingHarga) {
            return redirect()->route('admin.harga')
                ->with('error', 'Harga untuk kendaraan ini sudah ada! Silakan edit harga yang sudah ada.');
        }

        Harga::create([
            'id_kendaraan' => $request->id_kendaraan,
            'harga_perhari' => $request->harga_perhari,
            'tanggal_berlaku' => now() // Set tanggal berlaku ke hari ini
        ]);

        return redirect()->route('admin.harga')
            ->with('success', 'Harga berhasil ditambahkan!');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kendaraan' => 'required|exists:kendaraan,id_kendaraan',
            'harga_perhari' => 'required|numeric|min:0'
        ]);

        $harga = Harga::findOrFail($id);
        
        // Cek apakah sudah ada harga untuk kendaraan lain dengan ID yang sama
        $existingHarga = Harga::where('id_kendaraan', $request->id_kendaraan)
            ->where('id_harga', '!=', $id)
            ->first();

        if ($existingHarga) {
            return redirect()->route('admin.harga')
                ->with('error', 'Harga untuk kendaraan ini sudah ada!');
        }

        $harga->update([
            'id_kendaraan' => $request->id_kendaraan,
            'harga_perhari' => $request->harga_perhari
            // Tanggal berlaku tetap tidak diubah
        ]);

        return redirect()->route('admin.harga')
            ->with('success', 'Harga berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $harga = Harga::findOrFail($id);
        $harga->delete();

        return redirect()->route('admin.harga')
            ->with('success', 'Harga berhasil dihapus!');
    }
}