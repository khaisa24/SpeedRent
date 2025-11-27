<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;

    protected $table = 'harga';
    protected $primaryKey = 'id_harga';
    
    protected $fillable = [
        'id_kendaraan',
        'harga_perhari',
        'tanggal_berlaku'
    ];

    protected $casts = [
        'tanggal_berlaku' => 'date',
        'harga_perhari' => 'decimal:2'
    ];

    // Relasi ke model Kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id_kendaraan');
    }

    // Accessor untuk format harga
    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga_perhari, 0, ',', '.');
    }

    // Scope untuk harga aktif
    public function scopeAktif($query)
    {
        return $query->where('tanggal_berlaku', '<=', now());
    }
}