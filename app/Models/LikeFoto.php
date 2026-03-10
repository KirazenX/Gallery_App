<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeFoto extends Model
{
    protected $table = 'gallery_likefoto';
    protected $primaryKey = 'LikeID';

    protected $fillable = ['FotoID', 'UserID', 'TanggalLike'];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    public function foto()
    {
        return $this->belongsTo(Foto::class, 'FotoID', 'FotoID');
    }
}