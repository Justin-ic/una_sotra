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

    // id  lettre_guichet  services_id     personnel_id
        Schema::create('guichets', function (Blueprint $table) {
            $table->id();
            $table->char('lettre_guichet',2);
            
            // définition des cléef étrangères
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('personnel_id');
/*            $table->index('service');
            $table->index('personnel');*/
            
 
            // définition des relations
            $table->foreign('service_id')->references('id')->on('services');  
            $table->foreign('personnel_id')->references('id')->on('personnels');
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
