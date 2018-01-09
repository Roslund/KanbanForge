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
        Schema::table('cards', function ($table) {
            $table->foreign('artifact_id')->references('id')->on('artifacts')->onDelete('cascade');;
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('swimlane_id')->references('id')->on('swimlanes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('categories', function ($table) {
          $table->dropForeign(['parentcategory']);
      });

      Schema::table('cards', function ($table) {
          // Providing an array with all value didn't work, so I'm splitting it up.
          // This syntax means we don't have to provide the table name and the columns.
          $table->dropForeign(['artifact_id']);
          $table->dropForeign(['category_id']);
          $table->dropForeign(['swimlane_id']);
      });
    }
}
