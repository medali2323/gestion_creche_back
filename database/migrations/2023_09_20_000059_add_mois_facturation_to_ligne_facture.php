<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ligne_facture', function (Blueprint $table) {
            $table->integer('mois_facturation')->unsigned()->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('ligne_facture', function (Blueprint $table) {
            $table->dropColumn('mois_facturation');
        });
    }
    
};
