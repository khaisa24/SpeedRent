<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    // Accessor untuk jumlah hari
    public function getJumlahHariAttribute()
    {
        $start = Carbon::parse($this->tanggal_mulai);
        $end = Carbon::parse($this->tanggal_selesai);
        return $start->diffInDays($end) + 1; // Termasuk hari pertama
    }

    // Accessor untuk format total harga
    public function getTotalHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    // Scope untuk rental aktif
    public function scopeAktif($query)
    {
        return $query->whereIn('status_sewa', ['pending', 'berlangsung']);
    }

    // Scope untuk rental selesai
    public function scopeSelesai($query)
    {
        return $query->where('status_sewa', 'selesai');
    }
}