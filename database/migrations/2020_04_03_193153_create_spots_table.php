<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spots', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('island_id')->unsigned();
            $table->string('name',100);
            $table->string('image',255)->nullable();
            $table->string('short_description',255);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::table('spots', function (Blueprint $table) {

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
        Schema::dropIfExists('spots');
    }
}
