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
        Schema::table('inscription', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('anneescolaire_id')->nullable();
            $table->foreign('anneescolaire_id')->references('id')->on('anneescolaire');
            
            $table->unsignedBigInteger('enfant_id')->nullable();
            $table->foreign('enfant_id')->references('id')->on('enfant');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscription', function (Blueprint $table) {
            //
        });
    }
};
