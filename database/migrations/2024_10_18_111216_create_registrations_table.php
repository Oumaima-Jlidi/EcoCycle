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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id(); // Identifiant unique
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade'); // Référence à l'événement
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Référence à l'utilisateur
            $table->dateTime('registration_date'); // Date d'inscription
            $table->string('status')->default('en attente'); // Statut de l'inscription
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
    
};
