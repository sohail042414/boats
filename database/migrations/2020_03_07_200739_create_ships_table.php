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
            $table->text('title_description_1')->nullable();
            $table->text('title_description_2')->nullable();
            $table->text('title_description_3')->nullable();
            $table->integer('price')->default(0);           
            $table->integer('capacity')->default(0); 
            $table->integer('ship_type'); //small , big etc.
            $table->integer('cruise_category'); 
            $table->integer('capacity_category');  
            $table->integer('year_built')->default(2000);
            $table->integer('year_renovated')->default(0);
            $table->string('length',40)->nullable();
            $table->string('beam',40)->nullable();
            $table->string('draft',40)->nullable();
            $table->string('top_speed',40)->nullable();
            $table->string('crusing_speed',40)->nullable();
            $table->string('engines',40)->nullable();
            $table->integer('cabins')->default(1);
            $table->integer('bathrooms')->default(1);
            $table->string('electricity',40)->nullable();
            $table->string('gross_tonnage',40)->nullable();
            $table->string('water_capacity',40)->nullable();
            $table->string('fuel_capacity',40)->nullable();
            $table->string('fresh_water_maker',40)->nullable();
            $table->string('tenders',40)->nullable();
            $table->string('safety',40)->nullable();

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
