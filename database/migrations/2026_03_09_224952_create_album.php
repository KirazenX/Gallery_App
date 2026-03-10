<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_album', function (Blueprint $table) {
            $table->id('AlbumID');
            $table->string('NamaAlbum', 255);
            $table->text('Deskripsi')->nullable();
            $table->date('TanggalDibuat')->nullable();
            $table->unsignedBigInteger('UserID');
            $table->foreign('UserID')->references('UserID')->on('gallery_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_album');
    }
};