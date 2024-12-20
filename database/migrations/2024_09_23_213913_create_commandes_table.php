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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  
            $table->float('montant_total');  
            $table->string('statut')->default('en cours');  
            $table->timestamp('date_commande');  
            $table->string('adresse_livraison');  
            $table->json('produits');  
            $table->timestamps();

         
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('phone')->nullable(); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop foreign key constraint
        });

        Schema::dropIfExists('commandes');
    }
};
