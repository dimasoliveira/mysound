<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PlaylistController extends Controller {
  public function index() {

    $playlists = Playlist::where('user_id', Auth::user()->id)->get();

    return view('playlist.index', compact('playlists'));
  }

  public function show(Playlist $playlist) {

    if (isset($playlist)) {

      return view('playlist.show', compact('playlist'));
    }

    //$audio = Audio::findOrFail(1);

    //$playlist->audio()->save($audio);

    return redirect(route('myaudio.album.index'))->with('message', 'Unfortunately, the playlist cannot be found');
  }

  public function addToPlaylist(Playlist $playlist, Audio $audio) {

    $playlist->audio()->save($audio);

    return redirect()
      ->back()
      ->with('message', 'Added ' . $audio->title . ' to playlist ' . $playlist->name);
  }

  public function removeFromPlaylist($id) {

    DB::table('audio_playlists')->where('id', $id)->delete();

    return redirect()
      ->back()
      ->with('message', 'Succesfully removed from playlist');
  }

  public function store(Request $request) {

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

    return redirect()
      ->back()
      ->with('message', 'Succesfully added playlist ' . $request->name);
  }

  public function update(Request $request, Playlist $playlist) {

    $validator = Validator::make($request->all(), [
      'playlist_name' => 'required|max:50|min:1',
      'playlist_description' => 'max:100|min:1',

    ]);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->with('playlistValidationError', 'Adding playlist failed')
        ->withInput();
    }

    $playlist->name = $request->playlist_name;
    $playlist->description = $request->playlist_description;
    $playlist->save();

    return redirect()
      ->back()
      ->with('message', 'Succesfully edited playlist name to' . $playlist->name);
  }
}
