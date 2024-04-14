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
        // Schema::table('wajib_pajak', function (Blueprint $table) {
        //     $table->unsignedBigInteger('id_user');
        //     $table->foreign('id_user')->references('id')->on('users');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('wajib_pajak', function (Blueprint $table) {
        //     $table->dropForeign('wajib_pajak_id_user_foreign');
        //     $table->dropColumn('id_user');
        // });
    }
};
