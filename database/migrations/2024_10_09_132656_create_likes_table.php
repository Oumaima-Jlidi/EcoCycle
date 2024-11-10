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
        Schema::create('likes', function (Blueprint $table) {
           
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->morphs('likeable'); // Crée les colonnes likeable_id et likeable_type pour la relation polymorphique
                $table->enum('type', ['like', 'dislike']);
                $table->timestamps();
        
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->unique(['user_id', 'likeable_id', 'likeable_type']);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
};
