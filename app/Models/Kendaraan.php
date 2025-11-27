<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';
    protected $primaryKey = 'id_kendaraan';
    protected $fillable = [
        'nama_kendaraan',
        'merek',
        'id_kategori',
        'deskripsi',
        'warna',
        'plat_nomor',
        'kapasitas',
        'bahan_bakar',
        'status',
        'foto',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    // Relasi dengan kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Relasi dengan harga
    public function harga()
    {
        return $this->hasOne(Harga::class, 'id_kendaraan', 'id_kendaraan');
    }

    // Accessor untuk foto URL
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : asset('images/default-car.jpg');
    }

    // Accessor untuk status badge - PASTIKAN INI BENAR
    public function getStatusBadgeAttribute()
    {
        $statusMap = [
            'Tersedia' => ['label' => 'Tersedia', 'color' => 'success'],
            'Disewa' => ['label' => 'Disewa', 'color' => 'warning'],
            'Maintenance' => ['label' => 'Maintenance', 'color' => 'danger']
        ];

        $config = $statusMap[$this->status] ?? ['label' => $this->status, 'color' => 'secondary'];
        
        return '<span class="badge bg-' . $config['color'] . '">' . $config['label'] . '</span>';
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'id_kendaraan', 'id_kendaraan');
    }
}