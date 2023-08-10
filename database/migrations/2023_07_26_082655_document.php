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
        //
        Schema::create('document', function (Blueprint $table) {
            $table->id();
            $table->string('nom_document');
            $table->string('pièce_jointe');
              $table->unsignedBigInteger('enfant_id')->nullable();
            $table->foreign('enfant_id')->references('id')->on('enfant');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
