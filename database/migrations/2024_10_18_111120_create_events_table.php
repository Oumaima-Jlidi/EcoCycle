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
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // Identifiant unique
            $table->string('title'); // Titre de l'événement
            $table->text('description'); // Description de l'événement
            $table->dateTime('start_date'); // Date de début
            $table->dateTime('end_date'); // Date de fin
            $table->string('location'); // Lieu de l'événement
            $table->integer('max_participants')->unsigned(); // Nombre max de participants
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('events');
    }
    
};
