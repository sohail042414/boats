<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_amenities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ship_id')->unsigned();
            $table->integer('amenity_id')->unsigned();
        });

        //add foreign keys
        Schema::table('ship_amenities', function (Blueprint $table) {
            $table->foreign('ship_id')
            ->references('id')
            ->on('ships')
            ->onDelete('cascade');
        });

        //add foreign keys
        Schema::table('ship_amenities', function (Blueprint $table) {
            $table->foreign('amenity_id')
            ->references('id')
            ->on('amenities')
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
        Schema::dropIfExists('ship_amenities');
    }
}
