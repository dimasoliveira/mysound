<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('title',50);
            $table->string('artist',50);
            $table->tinyInteger('tracknumber')->nullable();
            $table->boolean('explicit');
            $table->boolean('published');
            $table->integer('year')->nullable();
            $table->string('genre',50);
            $table->integer('length');
            $table->integer('bitrate');
            $table->string('coverart');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('album_id');
            $table->foreign('album_id')->references('id')->on('albums');
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
        Schema::dropIfExists('audio');
    }
}
