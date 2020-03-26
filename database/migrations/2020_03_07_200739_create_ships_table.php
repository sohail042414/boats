<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('ship_types', function (Blueprint $table) {
            $table->increments('id');
            //$table->primary('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        //ship or cruise category
        Schema::create('cruise_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('capacity_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('min')->default(17);
            $table->integer('max')->default(39);
            $table->timestamps();
        });

        Schema::create('ship_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ship_id');
            $table->string('name');
        });


        Schema::create('ships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image');
            $table->text('ship_link'); //external link
            $table->text('short_description');
            $table->text('title_description_1');
            $table->text('title_description_2');
            $table->text('title_description_3');
            $table->integer('price');           
            $table->integer('capacity'); 
            $table->integer('ship_type'); //small , big etc.
            $table->integer('cruise_category'); 
            $table->integer('capacity_category');  
            $table->integer('year_built');
            $table->integer('year_renovated');
            $table->integer('length');
            $table->integer('beam');
            $table->string('top_speed');
            $table->string('engines');
            $table->integer('cabins');
            $table->string('draft');
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
        Schema::dropIfExists('ships');
        Schema::dropIfExists('ship_images');
        Schema::dropIfExists('capacity_categories');
        Schema::dropIfExists('cruise_categories');
        Schema::dropIfExists('ship_types');
    }
}
