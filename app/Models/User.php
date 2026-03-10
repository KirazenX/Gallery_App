<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'gallery_user';
    protected $primaryKey = 'UserID';

    protected $fillable = [
        'Username', 'Password', 'Email', 'NamaLengkap', 'Alamat', 'role',
    ];

    protected $hidden = ['Password', 'remember_token'];

    protected $casts = ['Password' => 'hashed'];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    // Helper untuk cek apakah user adalah admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'UserID', 'UserID');
    }

    public function albums()
    {
        return $this->hasMany(Album::class, 'UserID', 'UserID');
    }
}