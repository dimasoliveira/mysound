<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioPlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_playlists', function (Blueprint $table) {
          $table->integer('audio_id')->unsigned();
          $table->foreign('audio_id')->references('id')->on('audio')->onDelete('cascade');
          $table->integer('playlist_id')->unsigned();
          $table->foreign('playlist_id')->references('id')->on('playlists');
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
        Schema::dropIfExists('audio_playlists');
    }
}
