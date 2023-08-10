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
            //
            Schema::create('message', function (Blueprint $table) {
                $table->id();
                $table->date('date_message');
                $table->string('objet_message');
                $table->string('contenu');
                
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->unsignedBigInteger('famille_id')->nullable();
                $table->foreign('famille_id')->references('id')->on('famille');
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
