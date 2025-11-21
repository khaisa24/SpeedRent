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
        'merek',
        'foto', 
        'deskripsi',
        'nama_kendaraan',
        'id_kategori',
        'status',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    // Relasi dengan kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Accessor untuk foto URL
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : asset('images/default-car.jpg');
    }

    // Accessor untuk status badge
    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'Tersedia' => 'success',
            'Disewa' => 'warning',
            'Maintenance' => 'danger'
        ];

        $color = $statuses[$this->status] ?? 'secondary';
        return '<span class="badge bg-' . $color . '">' . $this->status . '</span>';
    }
}