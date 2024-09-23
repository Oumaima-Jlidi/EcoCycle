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
        Schema::create('replay_sujets', function (Blueprint $table) {
            $table->id();
            $table->string('content'); // Type de déchet (organique, plastique, etc.)

            $table->foreignId('sujet_id')->constrained('sujets')->onDelete('cascade'); // Clé étrangère vers la collecte
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
        Schema::dropIfExists('replay_sujets');
    }
};
