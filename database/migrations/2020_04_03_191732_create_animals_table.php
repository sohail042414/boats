<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->enum('type', ['animal', 'bird']);
            $table->string('image',255)->nullable();
            $table->string('short_description',255);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('animals');
    }
}
