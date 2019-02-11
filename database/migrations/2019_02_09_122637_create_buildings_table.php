<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{

    public function up()
    {
        Schema::create('buildings', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('campus_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('buildings');
    }
}
