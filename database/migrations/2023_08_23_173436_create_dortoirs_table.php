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
        Schema::create('dortoir', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('salle_id')->nullable();
            $table->foreign('salle_id')->references('id')->on('salle');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dortoir');
    }
};
