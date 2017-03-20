<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioGenresTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('audio_genres', function (Blueprint $table) {
            $table->integer('audio_id')->unsigned()->nullable();
            $table->foreign('audio_id')->references('audio_id')->on('audio')->onDelete('cascade');
            $table->integer('genre_id')->unsigned()->nullable();
            $table->foreign('genre_id')->references('genre_id')->on('genres')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('audio_genres');
    }
}
