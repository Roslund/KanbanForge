<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtifactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('artifacts', function (Blueprint $table) {
            // In the API the id is a string for some reason
            //$table->increments('id');
            $table->string('id');
            $table->string('projectId');
            //In the API is called title and not name
            $table->string('title');
            // In the API is called createdDate and not date
            // Format "2017-12-04"
            //$table->date('date');
            $table->date('cratedDate');
            // In the API is called state and not status
            //$table->string('state');
            $table->string('status');
            $table->string('description');
            // In the API is called assignetTo instead of personAssigned
            //$table->string('personAssigned');
            $table->string('assignedTo');
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
        Schema::dropIfExists('artifacts');
    }
}
