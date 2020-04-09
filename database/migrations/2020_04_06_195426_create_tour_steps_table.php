<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_steps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('serial_no')->unsigned();
            $table->string('title',255);
            $table->integer('tour_id')->unsigned();
            $table->integer('island_id')->unsigned();
            $table->integer('spot_id')->unsigned();
            $table->dateTime('step_date',0);
            $table->enum('day_time', ['am', 'pm']);
            //$table->enum('day_time', ['morning', 'afternoon','evening','night']);
            $table->timestamps();
        });

        //add foreign keys
        Schema::table('tour_steps', function (Blueprint $table) {
            $table->foreign('tour_id')
            ->references('id')
            ->on('tours')
            ->onDelete('cascade');
        });

        //add foreign keys
        Schema::table('tour_steps', function (Blueprint $table) {
            $table->foreign('island_id')
            ->references('id')
            ->on('islands')
            ->onDelete('NO ACTION');
        });

        //add foreign keys
        Schema::table('tour_steps', function (Blueprint $table) {
            $table->foreign('spot_id')
            ->references('id')
            ->on('spots')
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
        Schema::dropIfExists('tour_steps');
    }
}
