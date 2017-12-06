<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            
            //instead of this:
            $table->integer('artifact_id');
            $table->integer('category_id');
            $table->integer('swimlane_id');

            //should be like this:
            /*$table->integer('artifact')->unsigned();
            $table->integer('category')->nullable()->unsigned();
            $table->integer('swimlane')->nullable()->unsigned();

            $table->foreign('artifact')->references('id')->on('artifacts')->onDelete('cascade');
            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('swimlane')->references('id')->on('swimlanes')->onDelete('cascade');
            $table->timestamps();*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
