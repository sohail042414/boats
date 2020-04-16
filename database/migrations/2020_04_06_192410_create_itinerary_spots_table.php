<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItinerarySpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('itinerary_spots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('itinerary_id')->unsigned();
            $table->integer('spot_id')->unsigned();
        });

        //add foreign keys
        Schema::table('itinerary_spots', function (Blueprint $table) {
            $table->foreign('spot_id')
            ->references('id')
            ->on('spots')
            ->onDelete('cascade');
        });
        
        //add foreign keys
        Schema::table('itinerary_spots', function (Blueprint $table) {
            $table->foreign('itinerary_id')
            ->references('id')
            ->on('itineraries')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itinerary_spots');
    }
}
