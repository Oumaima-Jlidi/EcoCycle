<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collectes', function (Blueprint $table) {
            $table->float('quantite_collecte')->after('id'); 
            $table->string('type_dechet'); 
            $table->string('zone_collecte'); 
            $table->string('statut'); 
            $table->date('date_collecte'); 



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collectes', function (Blueprint $table) {
            $table->dropColumn('quantite_collecte');  
            $table->dropColumn('type_dechet'); 
            $table->dropColumn('zone_collecte'); 
            $table->dropColumn('statut'); 
            $table->dropColumn('date_collecte'); 
              });
    }
};
