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
        Schema::create('famille', function (Blueprint $table) {
            $table->id();
            $table->string('nom_pere');
            $table->string('prenom_pere');
            $table->string('numero_telephone_pere');
            $table->string('numero_cin_pere')->unique();
            $table->string('email_pere')->unique();
            $table->string('adresse_pere');

            $table->string('nom_mere');
            $table->string('prenom_mere');
            $table->string('numero_telephone_mere');
            $table->string('numero_cin_mere')->unique();
            $table->string('email_mere')->unique();
            $table->string('adresse_mere');

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
