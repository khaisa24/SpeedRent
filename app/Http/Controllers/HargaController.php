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
            ->orderBy('tanggal_berlaku', 'desc')
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
            'harga_perhari' => 'required|numeric|min:0',
            'tanggal_berlaku' => 'required|date'
        ]);

        // Cek apakah sudah ada harga untuk kendaraan dan tanggal yang sama
        $existingHarga = Harga::where('id_kendaraan', $request->id_kendaraan)
            ->where('tanggal_berlaku', $request->tanggal_berlaku)
            ->first();

        if ($existingHarga) {
            return redirect()->route('admin.harga')
                ->with('error', 'Harga untuk kendaraan ini pada tanggal tersebut sudah ada!');
        }

        Harga::create($request->all());

        return redirect()->route('admin.harga')
            ->with('success', 'Harga berhasil ditambahkan!');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kendaraan' => 'required|exists:kendaraan,id_kendaraan',
            'harga_perhari' => 'required|numeric|min:0',
            'tanggal_berlaku' => 'required|date'
        ]);

        $harga = Harga::findOrFail($id);
        
        // Cek apakah sudah ada harga untuk kendaraan dan tanggal yang sama (kecuali diri sendiri)
        $existingHarga = Harga::where('id_kendaraan', $request->id_kendaraan)
            ->where('tanggal_berlaku', $request->tanggal_berlaku)
            ->where('id_harga', '!=', $id)
            ->first();

        if ($existingHarga) {
            return redirect()->route('admin.harga')
                ->with('error', 'Harga untuk kendaraan ini pada tanggal tersebut sudah ada!');
        }

        $harga->update($request->all());

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