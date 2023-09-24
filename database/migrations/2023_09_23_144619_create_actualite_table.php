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
        Schema::create('Actualite', function (Blueprint $table) {
            $table->id();
            $table->string('objet');
            $table->string('pièce_jointe')->nullable();
            $table->text('contenu');
            $table->date('date');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Actualite');
    }
};
