<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients_locations', function (Blueprint $table) {
            $table->id();

           // définition des cléef étrangères
                            // pour la mise à jour
            $table->unsignedBigInteger('clientId');// Relation One to many etudiants est le père
 
            // définition des relations
            $table->foreign('clientId')->references('id')->on('etudiants')->onDelete('cascade')->onUpdate('cascade'); 

            $table->char('clientNumero',11);// pour l'envoie de message dynamique
            $table->char('clientTicket',10);// pour la reconnexion et l'affichage
            $table->integer('nbClientAvant');// pour l'affichage
            $table->time('tAttenteEstime');// pour l'affichage
            $table->char('nom',30);// pour l'affichage
            $table->char('prenom',30);// pour l'affichage
            $table->char('genre',10);// pour l'affichage
            $table->char('clientLatitude',30)->nullable(); // Car venant du java scripte
            $table->char('clientLongitude',30)->nullable();
            $table->char('distance',30)->nullable(); // distance entre le client et le guichet
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
        Schema::dropIfExists('clients_locations');
    }
}
