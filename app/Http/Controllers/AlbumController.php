<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Album;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller {
  /**
   * AlbumController constructor.
   *
   * In de album constructor haal ik alle lege albums op en verwijder die inclusief hun coverart
   */

  public function __construct() {
    $this->getEmptyAlbums();
  }

  /** Index
   * Hier haal ik alle albums op die gemaakt zijn door de ingelogde user
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */

  public function index() {

    $albums = Album::all()->where('user_id', Auth::user()->id);

    return view('myaudio.album.index', compact('albums'));
  }

  /** Show
   *
   * Hier haal ik het opgevraagde album op
   * @param \App\Album $album
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
   */

  public function show(Album $album) {

    $playlists = Playlist::where('user_id', Auth::user()->id)->get();

    if (isset($album)) {

      //Hier stuur ik alle artisten die voorkomen in het album naar de view
      if ($album->artist == NULL) {
        foreach ($album->audio as $song) {

          $artist[] = $song->artist;

          $album->artist = array_unique($artist);
        }
      }

      foreach ($album->audio as $song) {

        $year[] = $song->year;
        $genres[] = $song->genre->name;

        $album->genres = array_unique($genres);
        $album->year = array_unique($year);
      }

      return view('myaudio.album.show', compact('album'), compact('playlists'));
    }

    return redirect(route('myaudio.albums'))->with('message', 'Unfortunately, the album cannot be found');
  }

  /**
   * @param \Illuminate\Http\Request $request
   * @param \App\Album $album
   *
   * @return \Illuminate\Http\RedirectResponse
   */

  public function update(Request $request, Album $album) {

    $this->validate($request, [
      'album_name' => 'nullable|max:50',
      'coverart' => 'nullable|image|file|dimensions:ratio=1/1',
    ]);

    // Checkt of album al bestaat
    $duplicate_album = Album::where('name', $request->album_name)
      ->where('user_id', Auth::user()->id)
      ->first();

    // Als album niet bestaat, dan maakt hij er een aan
    if (is_null($duplicate_album)) {

      if (!empty($request->album_name)) {

        $album->update(['name' => $request->album_name]);
      }

      if (!empty($request->coverart)) {

        if (Storage::exists($album->coverart)) {
          Storage::delete($album->coverart);
        }

        $album->update([
          'coverart' => $request->coverart = request()
            ->file('coverart')
            ->store('public/coverarts')
        ]);
      }

      return redirect()->intended(route('myaudio.album.show', $album->slug));
    }

    else {
      foreach ($album->audio as $song) {
        $song->update(['album_id' => $duplicate_album->id]);
      }
      return redirect()->intended(route('myaudio.album.show', $duplicate_album->slug));
    }
  }

  /** getEmptyAlbums
   *
   * Zorgt ervoor dat albums die leeg zijn worden verwijderd
   *
   */
  public function getEmptyAlbums() {

    $empty_albums = Album::whereNotExists(function ($query) {
      $query->select(DB::raw(1))
        ->from('audio')->whereRaw('albums.id = audio.album_id');
    })->get();

    foreach ($empty_albums as $empty_album) {
      if (Storage::exists($empty_album->coverart)) {
        Storage::delete($empty_album->coverart);
      }
      $empty_album->delete();
    }
  }
}
