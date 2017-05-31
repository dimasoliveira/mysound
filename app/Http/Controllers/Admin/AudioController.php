<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Audio;
use App\Genre;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AudioController extends Controller
{

  public function index(){

    $audio = Audio::all();

    return view('admin.audio.index', compact('audio'));
  }

  public function edit(Audio $audio){

    return view('admin.audio.edit', compact('audio'));
  }

  public function update(Request $request,Audio $audio) {

    $validator = Validator::make($request->all(), [
      'title' => 'required|max:255',
      'artist' => 'required|max:50',
      'album' => 'nullable|max:50',
      'genre' => 'required|max:50',
      'coverart' => 'nullable',
      'year' => 'nullable|digits:4',
      'tracknumber' => 'nullable|max:99',
    ]);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->with('audioEditValidationError', "jaa".$request->id)
        ->withInput();
    }

    if ($request->explicit == "on") {
      $request->explicit = 1;
    }
    else {
      $request->explicit = 0;
    }

    if ($request->published == "on") {
      $request->published = 1;
    }
    else {
      $request->published = 0;
    }

    if ($request->coverart !== NULL && file_exists(request()->file('coverart'))) {

      $request->coverart = request()->file('coverart')->store('public/coverarts');

      if (Storage::exists($audio->coverart) && Storage::exists($request->coverart) && $audio->coverart !== "/defaults/coverart.png"){
        Storage::delete($audio->coverart);
      }

    }
    else {
      $request->coverart = $audio->coverart;
    }

    $request->album_id = Album::where('name', $request->album)
      ->where('user_id', Auth::user()->id)
      ->value('id');

    //if not, create the album and pass the album id
    if ($request->album_id == NULL) {

      $newAlbum = Album::create([
        'name' => $request->album,
        'user_id' => Auth::user()->id,
      ]);

      $request->album_id = $newAlbum->id;
    }

    $audio->title = $request->title;
    $audio->artist = $request->artist;
    $audio->album_id = $request->album_id;
    $audio->tracknumber = $request->tracknumber;
    $audio->explicit = $request->explicit;
    $audio->published = $request->published;
    $audio->year = $request->year;
    $audio->coverart = $request->coverart;
    $audio->genre_id = $request->genre;
    $audio->save();


    return redirect()
      ->back()
      ->with('message', 'Song succesfully edited');
  }

  public function destroy(Audio $audio)
  {

    if (Storage::exists($audio->filename)){
      Storage::delete($audio->filename);

      if (Storage::exists($audio->filename) == false)
      {
        if (Storage::exists($audio->coverart) && $audio->coverart !== "/defaults/coverart.png"){
          Storage::delete($audio->coverart);
        }

        $audio->delete();
      }

      return redirect()
        ->route('index')
        ->with('message', 'Bestand succesvol verwijderd');
    }
    return redirect()
      ->back()
      ->with('message', 'Er is iets fout gegaan, probeer het nogmaals');

  }

}
