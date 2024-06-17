<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            // untuk membuat foreign key yang menghubungkan user_id pada tabel post dengan id pada tabel users. 
            // Opsi onDelete('cascade') berarti jika pengguna dihapus, semua postingan yang terkait dengan pengguna 
            // tersebut juga akan dihapus.
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
