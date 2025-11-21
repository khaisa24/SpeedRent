<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tentukan primary key custom
    protected $primaryKey = 'id_user';

    // Tentukan ini bukan auto-increment jika id_user bukan integer
    public $incrementing = true;

    // Tentukan tipe primary key
    protected $keyType = 'int';

    protected $fillable = [
        'nama_user',
        'email', 
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationship dengan tabel rental (jika ada)
    public function rentals()
    {
        return $this->hasMany(Rental::class, 'id_user', 'id_user');
    }
}