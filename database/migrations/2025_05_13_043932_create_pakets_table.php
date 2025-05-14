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
        Schema::create('pakets', function (Blueprint $table) {
            $table->id('id_paket');
            $table->string('nama_paket', 100);
            $table->date('tanggal_diterima');
            $table->unsignedBigInteger('id_kategori');
            $table->string('penerima_paket', 100);
            $table->string('pengirim_paket', 100);
            $table->string('isi_paket_yang_disita', 200)->nullable();
            $table->string('status_paket', 50); //Diambil/Belum Diambil


            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_pakets')->onDelete('cascade');
            $table->foreign('penerima_paket')->references('nis')->on('santris')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
