<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilanClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilan_clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clients_id');
            // $table->foreign('clients_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('etat');
            $table->char('commentaire',100)->nullable();
            $table->time('tempsArrive');
            $table->time('debutService');
            $table->time('finService');
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
        Schema::dropIfExists('bilan_clients');
    }
}
