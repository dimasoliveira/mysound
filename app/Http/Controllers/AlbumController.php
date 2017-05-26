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
   * In the album constructor I'm getting all the empty albums, and delete them
   * with their coverart
   */

  public function __construct() {
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

  /**
   * Here I'm getting all the albums that are created by the authenticated user
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */

  public function index() {

    $albums = Album::all()->where('user_id', Auth::user()->id);

    return view('myaudio.album.index', compact('albums'));
  }

  /**
   *
   *
   * @param \App\Album $album
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
   */

  public function show(Album $album) {

    $playlists = Playlist::where('user_id', Auth::user()->id)->get();

    if (isset($album)) {

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

  public function update(Request $request, Album $album) {

    $this->validate($request, [
      'album_name' => 'nullable|max:50',
      'coverart' => 'nullable|image|file|dimensions:ratio=1/1',
    ]);

    $duplicate_album = Album::where('name', $request->album_name)
      ->where('user_id', Auth::user()->id)
      ->first();

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
}
