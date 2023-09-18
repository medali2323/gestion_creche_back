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
        Schema::table('inscription', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('type_inscriptions_id')->nullable();
            $table->foreign('type_inscriptions_id')->references('id')->on('type_inscriptions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscription', function (Blueprint $table) {
            //
        });
    }
};
