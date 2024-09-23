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
        Schema::create('dechets', function (Blueprint $table) {
            $table->id();
            $table->string('type_dechet'); // Type de déchet (organique, plastique, etc.)
            $table->float('quantite'); // Quantité du déchet
            $table->string('origine')->nullable(); // Origine du déchet (ex: ménage, restaurant)
            $table->date('date_collecte'); // Date de collecte du déchet
            $table->string('statut')->default('Collecté'); // Statut du déchet (ex : Collecté, Recyclé)
            $table->foreignId('collecte_id')->constrained('collectes')->onDelete('cascade'); // Clé étrangère vers la collecte
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
        Schema::dropIfExists('dechets');
    }
};
