<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

    // id  description     ticket  tAttenteEstime  nbClientAvant   clients_id
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->char('description',100); 
            $table->char('ticket',100);
            $table->time('tAttenteEstime');
            $table->integer('nbClientAvant');

           // définition des cléef étrangères
            $table->unsignedBigInteger('clients_id');
 
            // définition des relations
            $table->foreign('clients_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');  

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
        Schema::dropIfExists('tickets');
    }
}
