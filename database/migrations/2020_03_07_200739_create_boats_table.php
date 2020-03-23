<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('boat_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('boat_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('boats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('short_description');
            $table->text('description');
            $table->integer('type'); //small , big etc.
            $table->integer('class'); // luxury , first class, mid range, budget clas etc. etc.
            $table->integer('price');            
            $table->integer('capacity');
            $table->integer('year_built');
            $table->integer('length');
            $table->integer('beam');
            $table->string('speed');
            $table->string('draft');
            $table->string('main_engines');
            $table->string('gross_tonnage');
            $table->string('electricity');
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
        Schema::dropIfExists('boats');
        Schema::dropIfExists('boat_types');
        Schema::dropIfExists('boat_classes');
    }
}
