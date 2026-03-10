<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_likefoto', function (Blueprint $table) {
            $table->id('LikeID');
            $table->unsignedBigInteger('FotoID');
            $table->unsignedBigInteger('UserID');
            $table->date('TanggalLike')->nullable();
            $table->foreign('FotoID')->references('FotoID')->on('gallery_foto')->onDelete('cascade');
            $table->foreign('UserID')->references('UserID')->on('gallery_user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_likefoto');
    }
};