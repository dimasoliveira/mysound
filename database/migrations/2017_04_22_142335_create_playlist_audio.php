<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistAudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_audio', function (Blueprint $table) {
          $table->integer('audio_id')->unsigned();
          $table->foreign('audio_id')->references('audio_id')->on('audio')->onDelete('cascade');
          $table->integer('playlist_id')->unsigned();
          $table->foreign('playlist_id')->references('playlist_id')->on('playlists');
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
        //
    }
}
