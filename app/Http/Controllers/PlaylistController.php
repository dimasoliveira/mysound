<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
  public function index(){

    $playlists = Playlist::where('user_id',Auth::user()->id)->get();

    return view('myaudio.playlist.index',compact('playlists'));
  }

  public function show(Playlist $playlist){

    if (isset($playlist)){

      return view('myaudio.playlist.show',compact('playlist'));
    }

    //$audio = Audio::findOrFail(1);

    //$playlist->audio()->save($audio);

    return redirect(route('myaudio.album.index'))->with('message', 'Unfortunately, the playlist cannot be found');

  }

  public function addToPlaylist($playlist,$audio){

    dd($audio);

  }
}
