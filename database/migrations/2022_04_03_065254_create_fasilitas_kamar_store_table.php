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
        Schema::create('fasilitas_kamar_store', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kamar_id')->references('id')->on('kamar')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('fasilitasKamar_id')->references('id')->on('fasilitas_kamar')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('fasilitas_kamar_stores');
    }
};
