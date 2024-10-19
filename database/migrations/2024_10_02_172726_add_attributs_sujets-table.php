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
        Schema::table('sujets', function (Blueprint $table) {
            $table->text('description');
            $table->string('image')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sujets', function (Blueprint $table) {
            $table->dropForeign(['user_id']); 
            $table->dropColumn('user_id');  
            $table->dropColumn('image');  
            $table->dropColumn('description');  

            //
        });
    }
};
