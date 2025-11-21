<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $table = 'rental';
    protected $primaryKey = 'id_rental';
    
    protected $fillable = [
        'id_user',
        'id_kendaraan',
        'tanggal_mulai',
        'tanggal_selesai',
        'total_harga',
        'status_sewa'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'total_harga' => 'decimal:2'
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi ke model Kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id_kendaraan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_rental', 'id_rental');
    }
}