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
            $table->increments('audio_id');
            $table->string('filename');
            $table->string('title');
            $table->string('artist');
            $table->tinyInteger('tracknumber')->nullable();
            $table->boolean('explicit');
            $table->boolean('private');
            $table->integer('year')->nullable();
            $table->integer('length');
            $table->integer('bitrate');
            $table->string('coverart')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->unsignedInteger('album_id');
            $table->foreign('album_id')->references('album_id')->on('albums');
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
