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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable(false); // Ajouter la colonne role_id
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->string('image')->nullable();
     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);

            // Supprimer la colonne image
            $table->dropColumn('image');

            // Supprimer la colonne role_id
            $table->dropColumn('role_id');
        });
    }
};
