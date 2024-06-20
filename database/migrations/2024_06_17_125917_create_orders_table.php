<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->double('total_berat');
            $table->string('jenis_layanan');
            $table->string('jenis_proses');
            $table->string('jenis_pembayaran');
            $table->string('status');
            $table->date('dead_line');
            $table->timestamps(); // Hapus jika Anda tidak menggunakan timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
