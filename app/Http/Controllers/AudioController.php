<?php

namespace App\Http\Controllers;

use App\Album;
use App\Genre;
use Illuminate\Support\Facades\Gate;
use App\Audio;
use App\MP3File;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller {

  public function index() {

    $audio_posts = Audio::orderBy('created_at', 'desc')
      ->where('user_id', Auth::user()->id)->get();

    return view('myaudio.index', compact('audio_posts'));
  }

  public function create() {

    $genres = Genre::all();
    return view('forms.audio.create',compact('genres'));
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'title' => 'required|max:255',
      'artist' => 'required|max:50',
      'album' => 'nullable|max:50',
      'genre' => 'required',
      'coverart' => 'nullable',
      'filename' => 'required|mimes:mpga',
      'year' => 'nullable|digits:4',
      'tracknumber' => 'nullable|max:99',]);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->with('audioAddValidationError', 'Adding audio failed')
        ->withInput();
    }

    if (!file_exists(request()->file('filename'))) {
      return redirect()->back()->with('message', 'Something went wrong, try again')->withInput();
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

     if (Auth::user()->uploadLimitCheck(($audioData = new MP3File($request->filename))->getDuration())){
       return redirect()->back()->with('audioAddValidationError', 'Adding audio failed')
         ->with('message', 'No enough space left, Try delete existing songs to free space')
         ->withInput();
     }

        if ($request->coverart !== NULL && file_exists(request()->file('coverart'))) {
          $request->coverart = request()->file('coverart')->store('public/coverarts');
        }
        else{
          $request->coverart = "/defaults/coverart.png";
        }

        $audioData->storeAsMP3($request);

        if (!Album::where('name', $request->album)->where('user_id', Auth::user()->id)->exists()) {

          Album::create([
            'name' => $request->album,
            'user_id' => Auth::user()->id,
          ]);

          $request->album_id = \DB::getPdo()->lastInsertId();
        }
        else{
          $request->album_id = Album::where('name', $request->album)->where('user_id', Auth::user()->id)->first()->id;
        }

        Audio::create([
            'filename' => $request->filename,
            'title' => $request->title,
            'artist' => $request->artist,
            'album_id' => $request->album_id,
            'tracknumber' => $request->tracknumber,
            'published' => $request->published,
            'genre_id' => Genre::where('name',$request->genre)->first()->id,
            'explicit' => $request->explicit,
            'year' => $request->year,
            'length' => $audioData->getDuration(),
            'bitrate' => $audioData->getMP3BitRate(),
            'coverart' => $request->coverart,
            'user_id' => Auth::user()->id,
          ]
        );

        return redirect()->back()->with('message', 'File succesfully added');
  }

  public function edit(Audio $audio) {

      $genres = Genre::all();
      return view('forms.audio.edit', compact('audio','genres'));
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

    $request->album_id = \DB::table('albums')
      ->where('name', $request->album)
      ->where('user_id', Auth::user()->id)
      ->value('id');

    //if not, create the album and pass the album id
    if ($request->album_id == NULL) {

      Album::create([
        'name' => $request->album,
        'user_id' => Auth::user()->id,
      ]);

      $request->album_id = \DB::getPdo()->lastInsertId();
    }

      $audio->title = $request->title;
      $audio->artist = $request->artist;
      $audio->album_id = $request->album_id;
      $audio->tracknumber = $request->tracknumber;
      $audio->explicit = $request->explicit;
      $audio->published = $request->published;
      $audio->year = $request->year;
      $audio->coverart = $request->coverart;
      $audio->genre_id = Genre::where('name',$request->genre)->first()->id;
      $audio->save();

    return redirect()
      ->back()
      ->with('message', 'File succesfully edited');
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
