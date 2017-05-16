<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PlaylistController extends Controller
{
  public function index(){

    $playlists = Playlist::where('user_id',Auth::user()->id)->get();

    return view('playlist.index',compact('playlists'));
  }

  public function show(Playlist $playlist){

    if (isset($playlist)){

      return view('playlist.show',compact('playlist'));
    }

    //$audio = Audio::findOrFail(1);

    //$playlist->audio()->save($audio);

    return redirect(route('myaudio.album.index'))->with('message', 'Unfortunately, the playlist cannot be found');

  }

  public function addToPlaylist($playlist,$audio){

    dd($audio);

  }

  public function store(Request $request){

    $validator = Validator::make($request->all(), [
      'name' => 'required|max:50|min:1',
      'description' => 'max:255',
    ]);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->with('playlistValidationError', 'Adding playlist failed')
        ->withInput();
    }

    Playlist::create([
      'name' => $request->name,
      'description' => $request->description,
      'user_id' => Auth::user()->id
    ]);


    return redirect()->back()->with('message', 'Succesfully added playlist '.$request->name);
  }
}
