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
        Schema::table('facture', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('tva_id')->nullable();
            $table->foreign('tva_id')->references('id')->on('tva');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facture', function (Blueprint $table) {
            //
        });
    }
};
