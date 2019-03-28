<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('camera_id');
            $table->unsignedBigInteger('person_id');
            $table->boolean('successful');
            $table->text('notes');
            $table->timestamp('timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('position_reports');
    }
}