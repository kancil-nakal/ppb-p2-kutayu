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
        Schema::create('wajib_pajak', function (Blueprint $table) {
            $table->id();
            $table->string('no_sppt');
            $table->string('nama');
            $table->year('tahun');
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('alamat_pemilik')->nullable();
            $table->string('objek_pajak');
            $table->integer('luas_bumi');
            $table->integer('luas_bangunan');
            $table->float('pagu_pajak');
            $table->string('nama_penarik')->nullable();
            $table->boolean('status')->nullable();
            $table->date('tgl_setoran')->nullable();
            $table->integer('setoran_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wajib_pajak');
    }
};
