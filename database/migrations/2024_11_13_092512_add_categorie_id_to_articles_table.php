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
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('categorie_article_id')->nullable(); // Ajoute la colonne
            $table->foreign('categorie_article_id')->references('id')->on('categorie_articles'); // Ajoute la clé étrangère
        });
    }
    
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['categorie_article_id']);
            $table->dropColumn('categorie_article_id');
        });
    }
    
};
