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
        Schema::create('activite_enfant', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activite_id')->nullable();
            $table->foreign('activite_id')->references('id')->on('activite');
            
            $table->unsignedBigInteger('enfant_id')->nullable();
            $table->foreign('enfant_id')->references('id')->on('enfant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activite_enfants');
    }
};
