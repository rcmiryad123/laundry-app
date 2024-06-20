<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketLaundryTable extends Migration
{
    public function up()
    {
        Schema::create('paket_laundry', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->integer('harga_per_kg');
            $table->string('proses_cuci');
            $table->string('mesin_pengering');
            $table->boolean('lipat_rapi');
            $table->boolean('setrika');
            $table->string('lama_pelayanan')->nullable();
            $table->text('keterangan_tambahan')->nullable();
            // Foreign keys or other relationships can be defined here
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paket_laundry');
    }
}
