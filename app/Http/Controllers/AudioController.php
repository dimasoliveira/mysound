<?php

namespace App\Http\Controllers;

use App\Album;
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
  public function __construct() {
    $this->middleware('auth');
  }

  public function index() {

    //dd(Gate::allows('update-audio'));


    $audio_posts = Audio::orderBy('created_at', 'desc')
      ->where('user_id', Auth::user()->id)
      ->get();

    return view('myaudio.recent', compact('audio_posts'));
  }

  public function create() {

    return view('forms.add_audio');
  }

  public function store(Request $request) {


    //dd($request->tracknumber);
    $this->validate($request, [
      'title' => 'required|max:255',
      'artist' => 'required|max:50',
      'album' => 'nullable|max:50',
      'genre' => 'required|max:50',
      'coverart' => 'nullable',
      'filename' => 'required|mimes:mpga',
      'year' => 'nullable|digits:4',
      'tracknumber' => 'nullable|max:99',
    ]);

    if (Input::file('filename')->getClientOriginalExtension() == 'mp3') {

      $audio_data = new MP3File($request->filename);

      $request->length = $audio_data->getDuration();
      $request->bitrate = $audio_data->getMP3BitRate();

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

      if ($request->filename !== NULL && file_exists(request()->file('filename'))) {

        if ($request->coverart !== NULL && file_exists(request()->file('coverart'))) {
          $request->coverart = request()->file('coverart')->store('public/coverarts');
        }
        else{
          $request->coverart = "/defaults/coverart.png";
        }

        $request->filename = request()->file('filename')->store('public/audio');

        Storage::move($request->filename, dirname($request->filename) . '/' . basename($request->filename, ".mpga") . '.mp3');

        $request->filename = dirname($request->filename) . '/' . basename($request->filename, ".mpga") . '.mp3';

        //if (file_exists($request->filename)){
        //\DB::table('albums')->where('role_name', 'user')->value('role_id');

        //check if album exists
        $request->album_id = \DB::table('albums')
          ->where('name', $request->album)
          ->where('user_id', Auth::user()->id)
          ->value('id');

        //if not, create the album and pass the album id
        if ($request->album_id === NULL) {

          Album::create([
            'name' => $request->album,
            'user_id' => Auth::user()->id,
          ]);

          $request->album_id = \DB::getPdo()->lastInsertId();
        }

        Audio::create([
            'filename' => $request->filename,
            'title' => $request->title,
            'artist' => $request->artist,
            'album_id' => $request->album_id,
            'tracknumber' => $request->tracknumber,
            'published' => $request->published,
            'genre' => $request->genre,
            'explicit' => $request->explicit,
            'year' => $request->year,
            'length' => $request->length,
            'bitrate' => $request->bitrate,
            'coverart' => $request->coverart,
            'user_id' => Auth::user()->id,
          ]
        );

//        }else{
//          return redirect()->back()->with('message', 'MP3 Bestand niet gevonden');
//        }
      }
      else {
        return redirect()
          ->back()
          ->with('message', 'Er is helaas iets fout gegaan, probeer het opnieuw');
      }

      return redirect()
        ->back()
        ->with('message', 'Bestand succesvol toegevoegd');
    }

    else {
      return redirect()
        ->back()
        ->with('message', 'Bestandformaat is geen mp3');
    }
  }

  public function edit($id) {

    $audio = Audio::findOrfail($id);
    $this->authorize('update-audio',$audio);

    return view('forms.edit_audio', compact('audio'));
  }

  public function update(Request $request) {

//    dd($request);
    $old_audio = Audio::find($request->id);

    $this->validate($request, [
      'title' => 'required|max:255',
      'artist' => 'required|max:50',
      'album' => 'nullable|max:50',
      'genre' => 'required|max:50',
      'coverart' => 'nullable',
      'year' => 'nullable|digits:4',
      'tracknumber' => 'nullable|max:99',
    ]);

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

      if (Storage::exists($old_audio->coverart) && Storage::exists($request->coverart) && $old_audio->coverart !== "/defaults/coverart.png"){
        Storage::delete($old_audio->coverart);
      }

    }
    else {
      $request->coverart = $old_audio->coverart;
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

    $old_audio->title = $request->title;
    $old_audio->artist = $request->artist;
    $old_audio->album_id = $request->album_id;
    $old_audio->tracknumber = $request->tracknumber;
    $old_audio->explicit = $request->explicit;
    $old_audio->published = $request->published;
    $old_audio->year = $request->year;
    $old_audio->coverart = $request->coverart;
    $old_audio->genre = $request->genre;
    $old_audio->save();

//        }else{
//          return redirect()->back()->with('message', 'MP3 Bestand niet gevonden');
//        }

    return redirect()
      ->back()
      ->with('message', 'Bestand succesvol toegevoegd');
  }

  public function destroy($id)
  {

    $audio = Audio::findOrFail($id);

    if (Storage::exists($audio->filename)){
      Storage::delete($audio->filename);

      if (Storage::exists($audio->filename) == false)
      {
        if (Storage::exists($audio->coverart) && $audio->coverart !== "/defaults/coverart.png"){
          Storage::delete($audio->coverart);
        }

        $audio->delete();
      }
    }

    return redirect()->route('myaudio.index');
  }
}
