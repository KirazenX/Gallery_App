<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_foto', function (Blueprint $table) {
            $table->id('FotoID');
            $table->string('JudulFoto', 255);
            $table->text('DeskripsiFoto')->nullable();
            $table->date('TanggalUnggah')->nullable();
            $table->string('LokasiFile', 255);
            $table->unsignedBigInteger('AlbumID')->nullable();
            $table->unsignedBigInteger('UserID');
            $table->foreign('AlbumID')->references('AlbumID')->on('gallery_album')->onDelete('set null');
            $table->foreign('UserID')->references('UserID')->on('gallery_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_foto');
    }
};