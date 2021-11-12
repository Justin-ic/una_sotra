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
        Schema::create('bilanClients', function (Blueprint $table) {
            $table->id();
            $table->char('demande',100); 
            $table->char('ticket',10);
            $table->time('tAttenteEstime');
            $table->integer('nbClientAvant');

            $table->time('debutService')->nullable();
            $table->time('finService')->nullable();
            $table->char('commentaire',100)->nullable();
            $table->integer('etat')->nullable();/*servi ou pas*/

           // définition des cléef étrangères
            $table->unsignedBigInteger('etudiants_id');// Relation One to many etudiants est le père
            // $table->unsignedBigInteger('services_id');// Relation One to many services est le père
 
            // définition des relations
            $table->foreign('etudiants_id')->references('id')->on('etudiants')->onDelete('cascade')->onUpdate('cascade'); 

            // $table->foreign('services_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');  

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
