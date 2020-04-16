<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ship_id')->unsigned();
            $table->string('code',10)->nullable();
            $table->string('title',50)->nullable();
            $table->dateTime('start_date',0);
            $table->dateTime('end_date',0);
            $table->timestamps();
        });

        //add foreign keys
        Schema::table('itineraries', function (Blueprint $table) {
            $table->foreign('ship_id')
            ->references('id')
            ->on('ships')
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
        Schema::dropIfExists('itineraries');
    }
}
