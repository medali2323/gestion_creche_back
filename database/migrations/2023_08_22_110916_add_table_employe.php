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
        Schema::create('employe', function (Blueprint $table) {
            $table->id();
            $table->string('code');

            $table->string('nom_employe');
            $table->string('prenom_employe');
            $table->date('date_ness');
            $table->string('num_cin');
            $table->string('numero_tel');
            $table->string('adresse');
            $table->string('email');
            $table->string('niveau_scolaire');
            $table->date('date_emboche');
            $table->string('role');
            $table->boolean('etat_actuel'); 


            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employe_enfant');
    }
};
