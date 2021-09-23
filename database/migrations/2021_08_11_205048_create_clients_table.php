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


/*    id  nom     prenom  genre   numero  nce     debutService    finService  commentaire     servit */ 
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->char('nom',50);
            $table->char('prenom',50);
            $table->char('genre',2);
            $table->integer('numero');
            $table->char('nce',50);
            $table->time('debutService')->nullable();
            $table->time('finService')->nullable();
            $table->char('commentaire',100)->nullable();
            $table->integer('servit')->nullable();

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
