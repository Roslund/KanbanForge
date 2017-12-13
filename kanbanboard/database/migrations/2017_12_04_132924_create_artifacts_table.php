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
            $table->string('id')->primary();
            $table->string('title');
            $table->string('createdDate');
            $table->string('status');
            $table->longText('description');
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
