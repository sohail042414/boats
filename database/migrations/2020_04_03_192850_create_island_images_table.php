<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIslandImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('island_images', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('island_id')->unsigned();
            $table->string('name',255);
        });

        Schema::table('island_images', function (Blueprint $table) {

            $table->foreign('island_id')
            ->references('id')
            ->on('islands')
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
        Schema::dropIfExists('island_images');
    }
}
