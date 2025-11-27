<?php
// app/Models/Kategori.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    
    protected $fillable = [
        'nama_kategori',
        'jenis'
    ];

    // Relasi dengan kendaraan
    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class, 'id_kategori', 'id_kategori');
    }

    // Accessor untuk jumlah kendaraan
    public function getKendaraanCountAttribute()
    {
        return $this->kendaraans()->count();
    }
}