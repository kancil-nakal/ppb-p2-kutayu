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
        // Schema::create('setoran', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('id_wp');
        //     $table->foreign('id_wp')->references('id')->on('wajib_pajak')->onDelete('cascade');
        //     $table->date('tgl_setoran');
        //     $table->boolean('status')->default(0);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('setoran');
    }
};
