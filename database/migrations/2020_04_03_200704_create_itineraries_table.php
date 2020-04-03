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
            $table->string('title',255)->nullable();
            $table->text('details')->nullable();
            $table->dateTime('start_date',0);
            $table->dateTime('end_date',0);
            $table->smallInteger('nights')->default(0);
            $table->string('itinerary',30);
            $table->boolean('available')->defalut(true);
            $table->boolean('on_hold')->defalut(false);
            $table->integer('current_gross_rate');
            $table->integer('original_gross_rate');
            $table->integer('current_net_rate');
            $table->integer('original_net_rate');
            $table->string('promotion',255)->nullable();
            $table->timestamps();
        });

        //add foreign keys
        Schema::table('itineraries', function (Blueprint $table) {
            $table->foreign('ship_id')
            ->references('id')
            ->on('ships');
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
