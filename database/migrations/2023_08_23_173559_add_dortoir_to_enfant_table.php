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
        Schema::table('enfant', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('dortoir_id')->nullable();
            $table->foreign('dortoir_id')->references('id')->on('dortoir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enfant', function (Blueprint $table) {
            //
        });
    }
};
