<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Foto extends Model
{
    protected $table = 'gallery_foto';
    protected $primaryKey = 'FotoID';

    protected $fillable = [
        'JudulFoto', 'DeskripsiFoto', 'TanggalUnggah', 'LokasiFile', 'AlbumID', 'UserID',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'AlbumID', 'AlbumID');
    }

    public function komentars()
    {
        return $this->hasMany(KomentarFoto::class, 'FotoID', 'FotoID');
    }

    public function likes()
    {
        return $this->hasMany(LikeFoto::class, 'FotoID', 'FotoID');
    }
}