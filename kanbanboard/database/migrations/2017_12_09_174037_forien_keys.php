<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForienKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function ($table) {
            $table->foreign('parentcategory')->references('id')->on('parent_categories')->onDelete('cascade');
        });
        
        Schema::table('cards', function ($table) {
            $table->foreign('artifact')->references('id')->on('artifacts')->onDelete('cascade');;
            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('swimlane')->references('id')->on('swimlanes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
