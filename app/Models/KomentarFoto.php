<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarFoto extends Model
{
    protected $table = 'gallery_komentarfoto';
    protected $primaryKey = 'KomentarID';

    protected $fillable = ['FotoID', 'UserID', 'IsiKomentar', 'TanggalKomentar'];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    public function foto()
    {
        return $this->belongsTo(Foto::class, 'FotoID', 'FotoID');
    }
}