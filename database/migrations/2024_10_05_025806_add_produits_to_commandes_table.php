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
        Schema::table('commandes', function (Blueprint $table) {
            // Add adresse column (you can adjust the type as needed)
            $table->string('adresse_livraison')->after('statut');  // Add this line for the address

            // Add user_id column (assuming you're referencing the users table)
            $table->unsignedBigInteger('user_id')->after('adresse_livraison'); // Add this line for user_id
            
            // If you want to add a foreign key constraint
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
            // Remove adresse column
            $table->dropColumn('adresse_livraison');

            // Remove user_id column
            $table->dropColumn('user_id');

            // If you added a foreign key, you would drop it here as well
            // $table->dropForeign(['user_id']);
        });
    }
};
