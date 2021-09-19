<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->char('nom',50);
            $table->char('prenom',50);
            $table->char('genre',2);
            $table->integer('numero');
            $table->char('nce',50);
            $table->integer('servit');

// nom     prenom  genre   numero  nce     ticket_id   servit  created_at  updated_at  
            // définition des cléef étrangères
            $table->unsignedBigInteger('ticket_id');
            $table->index('ticket_id');

            // définition des relations
            $table->foreign('ticket_id')->references('id')->on('ticket');
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
        Schema::dropIfExists('clients');
    }
}
