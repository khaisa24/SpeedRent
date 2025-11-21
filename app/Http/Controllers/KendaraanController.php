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
            'status' => 'required|in:Tersedia,Disewa,Maintenance',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('kendaraan', 'public');
        }

        Kendaraan::create([
            'nama_kendaraan' => $request->nama_kendaraan,
            'merek' => $request->merek,
            'id_kategori' => $request->id_kategori,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'foto' => $fotoPath
        ]);

        return redirect()->route('admin.kendaraan')
            ->with('success', 'Kendaraan berhasil ditambahkan!');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kendaraan' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'deskripsi' => 'required|string',
            'status' => 'required|in:Tersedia,Disewa,Maintenance',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $data = $request->only(['nama_kendaraan', 'merek', 'id_kategori', 'deskripsi', 'status']);

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
}