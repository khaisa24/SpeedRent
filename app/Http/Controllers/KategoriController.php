<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori', compact('kategoris'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'jenis' => 'required|string|max:50'
        ]);

        Kategori::create($request->all());

        return redirect()->route('admin.kategori')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'jenis' => 'required|string|max:50'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('admin.kategori')
            ->with('success', 'Kategori berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori')
            ->with('success', 'Kategori berhasil dihapus!');
    }

    public function ownerIndex()
    {
        $kategoris = Kategori::all();
        return view('owner.kategori', compact('kategoris'));
    }
}