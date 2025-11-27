<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::with('kategori')->latest()->get();
        $kategoris = Kategori::all();
        return view('admin.kendaraan', compact('kendaraans', 'kategoris'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_kendaraan' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'deskripsi' => 'required|string',
            'warna' => 'required|string|max:100',
            'plat_nomor' => 'required|string|max:20|unique:kendaraan,plat_nomor',
            'kapasitas' => 'required|integer|min:1|max:20',
            'bahan_bakar' => 'required|in:Bensin,Solar,Listrik,Hybrid',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        try {
            // Upload foto
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('kendaraan', 'public');
            }
    
            Kendaraan::create([
                'nama_kendaraan' => $request->nama_kendaraan,
                'merek' => $request->merek,
                'id_kategori' => (int) $request->id_kategori,
                'deskripsi' => $request->deskripsi,
                'warna' => $request->warna,
                'plat_nomor' => $request->plat_nomor,
                'kapasitas' => (int) $request->kapasitas,
                'bahan_bakar' => $request->bahan_bakar,
                'status' => 'Tersedia',
                'foto' => $fotoPath
            ]);
    
            return redirect()->route('admin.kendaraan')
                ->with('success', 'Kendaraan berhasil ditambahkan!');
    
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan kendaraan: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kendaraan' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'deskripsi' => 'required|string',
            'warna' => 'required|string|max:100',
            'plat_nomor' => 'required|string|max:20|unique:kendaraan,plat_nomor,' . $id . ',id_kendaraan',
            'kapasitas' => 'required|integer|min:1|max:20',
            'bahan_bakar' => 'required|in:Bensin,Solar,Listrik,Hybrid',
            'status' => 'required|in:Tersedia,Disewa,Maintenance',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        try {
            $kendaraan = Kendaraan::findOrFail($id);
            
            $data = $request->only([
                'nama_kendaraan', 'merek', 'id_kategori', 'deskripsi', 
                'warna', 'plat_nomor', 'kapasitas', 'bahan_bakar', 'status'
            ]);
    
            // Upload foto baru jika ada
            if ($request->hasFile('foto')) {
                // Hapus foto lama
                if ($kendaraan->foto) {
                    Storage::disk('public')->delete($kendaraan->foto);
                }
                $data['foto'] = $request->file('foto')->store('kendaraan', 'public');
            }
    
            $kendaraan->update($data);
    
            return redirect()->route('admin.kendaraan')
                ->with('success', 'Kendaraan berhasil diupdate!');
    
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate kendaraan: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        
        // Hapus foto
        if ($kendaraan->foto) {
            Storage::disk('public')->delete($kendaraan->foto);
        }

        $kendaraan->delete();

        return redirect()->route('admin.kendaraan')
            ->with('success', 'Kendaraan berhasil dihapus!');
    }

    public function ownerIndex()
    {
        $kendaraans = Kendaraan::with(['kategori', 'harga'])->get();
        return view('owner.kendaraan', compact('kendaraans'));
    }
}