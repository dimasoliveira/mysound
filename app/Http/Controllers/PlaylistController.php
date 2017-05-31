<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PlaylistController extends Controller {
  /**
   * Index
   *
   * Hier worden alle playlists van de User opgehaalt en naar de view gestuurd
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   *
   */
  public function index() {

    $playlists = Playlist::where('user_id', Auth::user()->id)->get();

    return view('playlist.index', compact('playlists'));
  }

  /** Show
   *
   * Hier laat hij de opgevraagde playlist zien
   * @param \App\Playlist $playlist
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
   */
  public function show(Playlist $playlist) {

    if (isset($playlist)) {

      return view('playlist.show', compact('playlist'));
    }

    return redirect(route('myaudio.album.index'))->with('message', 'Unfortunately, the playlist cannot be found');
  }

  /** addToPlaylist
   *
   * Hier worden een link gemaakt tussen de opgevraagde song en de opgevraagde playlist
   * @param \App\Playlist $playlist
   * @param \App\Audio $audio
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function addToPlaylist(Playlist $playlist, Audio $audio) {

    if ($audio->published == 1 || $audio->user_id == Auth::user()->id){
      $playlist->audio()->save($audio);

      return redirect()
        ->back()
        ->with('message', 'Added ' . $audio->title . ' to playlist ' . $playlist->name);
    }

    return redirect()
      ->back()
      ->with('message', 'You cannot add ' . $audio->title . ' to playlist ' . $playlist->name);
  }

  /**removeFromPlaylist
   *
   * Hier wordt de link tussen een song en een playlist weer verwijderd
   *
   * @param $id
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function removeFromPlaylist($id) {

    DB::table('audio_playlists')->where('id', $id)->delete();

    return redirect()
      ->back()
      ->with('message', 'Succesfully removed from playlist');
  }

  /** Store
   *
   * In deze functie word de playlist opgeslagen
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return $this|\Illuminate\Http\RedirectResponse
   */
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

  /** Update
   *
   * In deze functie word de playlist gewijzigd
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Playlist $playlist
   *
   * @return $this|\Illuminate\Http\RedirectResponse
   */
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
      ->with('message', 'Succesfully edited playlist ' . $playlist->name);
  }
}
