<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFotoAndCaptionToPostinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post', function (Blueprint $table) {
            $table->string('foto')->nullable(); // Tambahkan kolom 'foto'
            $table->string('caption'); // Tambahkan kolom 'caption'
            $table->unsignedBigInteger('count_likes')->default(0);// Jumlah Like
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post', function (Blueprint $table) {
            $table->dropColumn('foto'); // Jika perlu, tambahkan perintah untuk menghapus kolom 'foto'
            $table->dropColumn('caption'); // Jika perlu, tambahkan perintah untuk menghapus kolom 'caption'
        });
    }
}
