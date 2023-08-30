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
        Schema::create('pointage_enfant', function (Blueprint $table) {
            $table->id();
            $table->string('code');

            $table->string('nom_activite');
            $table->date('datepointage'); // Champ date de pointage
            $table->time('heurepointage'); // Champ heure de pointage
        
            $table->unsignedBigInteger('enfant_id')->nullable();
            $table->foreign('enfant_id')->references('id')->on('enfant');

            $table->unsignedBigInteger('employe_enfant_id')->nullable();
            $table->foreign('employe_enfant_id')->references('id')->on('employe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pointage_enfant');
    }
};
