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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesan');
            $table->string('nama_tamu');
            $table->string('email');
            $table->string('no_hp')->nullable();
            $table->integer('jumlah_kamar_dipesan');
            $table->foreignId('kamar_id');
            $table->date('tanggal_checkin');
            $table->date('tanggal_checkout');
            $table->dateTime('tanggal_dipesan');
            $table->enum('status_pemesan', ['unpaid', 'checkin', 'checkout', 'cancel']);
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
        Schema::dropIfExists('pemesanans');
    }
};
