<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuichetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guichets', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            
            // définition des cléef étrangères
            $table->unsignedBigInteger('service');
            $table->unsignedBigInteger('personnel');
            $table->index('service');
            $table->index('personnel');
            
 
            // définition des relations
            $table->foreign('service')->references('id')->on('services');  
            $table->foreign('personnel')->references('id')->on('personnels');
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
        Schema::dropIfExists('guichets');
    }
}
