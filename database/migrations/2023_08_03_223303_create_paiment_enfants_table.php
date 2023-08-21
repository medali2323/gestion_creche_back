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
        Schema::create('paiment_enfant', function (Blueprint $table) {
            $table->id();
            $table->datetime('date_paiment');
            $table->decimal('montant_paiment', 10, 2);
            $table->unsignedBigInteger('inscription_id')->nullable(); $table->foreign('inscription_id')->references('id')->on('inscription');
            $table->unsignedBigInteger('mode_paiment_id')->nullable();$table->foreign('mode_paiment_id')->references('id')->on('mode_paiment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiment_enfant');
    }
};
