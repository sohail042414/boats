<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ship_id')->unsigned();
            $table->string('title',255)->nullable();
            $table->text('details')->nullable();
            $table->dateTime('start_date',0);
            $table->dateTime('end_date',0);
            $table->smallInteger('nights')->default(0);
            $table->integer('itinerary_id')->unsigned();
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
        Schema::table('tours', function (Blueprint $table) {
            $table->foreign('ship_id')
            ->references('id')
            ->on('ships')
            ->onDelete('NO ACTION');
        });

        //add foreign keys
        Schema::table('tours', function (Blueprint $table) {
            $table->foreign('itinerary_id')
            ->references('id')
            ->on('itineraries')
            ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tours');
    }
}
