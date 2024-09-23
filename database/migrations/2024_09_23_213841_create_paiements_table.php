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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
          
            $table->float('montant'); // Montant payé
            $table->string('methode'); // Méthode de paiement (ex: carte, PayPal)
            $table->timestamp('date_paiement'); // Date du paiement
            $table->string('statut')->default('en attente'); // Statut du paiement
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiements');
    }
};
