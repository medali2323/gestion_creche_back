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
        Schema::create('repas_enfants', function (Blueprint $table) {
            $table->id();
            $table->string('code');

            $table->unsignedBigInteger('repas_id')->nullable();
            $table->foreign('repas_id')->references('id')->on('repas');

            $table->unsignedBigInteger('inscription_id')->nullable();
            $table->foreign('inscription_id')->references('id')->on('inscription');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repas_enfants');
    }
};
