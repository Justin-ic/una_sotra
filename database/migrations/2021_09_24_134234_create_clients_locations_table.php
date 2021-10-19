<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *EN AS DE RECONNEXION
     * chaque 10s, on doit faire la mise à jour de la longitude et la latitude
     * S'il se reconnecte, continuer de décrementer le temps restant
     * 
     * CALCULS
     * date création --> tAttenteEstime
     * date actuel -->  X? = temps restant
     * date actuel - date création - tAttenteEstime == temps restant
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('clients_locations', function (Blueprint $table) {
            $table->id();
            $table->integer('clientId');// pour la mise à jour
            $table->integer('clientNumero');// pour l'envoie de message dynamique
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
