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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('titre'); // Titre de l'article
            $table->text('contenu'); // Contenu du blog
            $table->string('image')->nullable(); // Image associée au blog (facultatif)
            $table->string('Nom_auteur'); // Clé étrangère vers l'auteur (table users)
            $table->timestamp('date_publication')->nullable(); // Date de publication
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
        Schema::dropIfExists('articles');
    }
};
