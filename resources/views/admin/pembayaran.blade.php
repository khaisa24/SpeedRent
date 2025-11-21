<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    
    protected $fillable = [
        'id_rental',
        'id_user',
        'metode_pembayaran',
        'jumlah_bayar',
        'bukti_bayar'
    ];

    protected $casts = [
        'jumlah_bayar' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi ke model Rental
    public function rental()
    {
        return $this->belongsTo(Rental::class, 'id_rental', 'id_rental');
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}