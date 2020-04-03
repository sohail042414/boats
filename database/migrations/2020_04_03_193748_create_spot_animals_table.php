<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpotAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spot_animals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('spot_id')->unsigned();
            $table->integer('animal_id')->unsigned();
        });

        Schema::table('spot_animals', function (Blueprint $table) {
            $table->foreign('spot_id')
            ->references('id')
            ->on('spots');
        });

        Schema::table('spot_animals', function (Blueprint $table) {
            $table->foreign('animal_id')
            ->references('id')
            ->on('animals');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spot_animals');
    }
}
