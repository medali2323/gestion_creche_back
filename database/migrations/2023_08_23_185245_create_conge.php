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
        Schema::create('conge', function (Blueprint $table) {
            $table->id();
            $table->string('code');

            $table->date('date_deb');
            $table->date('date_fin');
            $table->unsignedBigInteger('employe_id')->nullable();
            $table->foreign('employe_id')->references('id')->on('employe');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
