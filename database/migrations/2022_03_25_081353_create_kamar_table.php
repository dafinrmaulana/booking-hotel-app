<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kamar');
            $table->integer('jumlah_kamar');
            $table->integer('jumlah_tersedia')->default(0);
            $table->integer('jumlah_terisi')->default(0);
            $table->integer('harga');
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
            // $table->foreignId('fasilitasKamar_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kamars');
    }
};
