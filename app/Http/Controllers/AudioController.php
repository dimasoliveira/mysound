<?php

namespace App\Http\Controllers;

use App\Audio;
use App\MP3File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller {
  public function index() {

    $audio_posts = Audio::all();

    foreach ($audio_posts as $audio_post) {
      $audio_post->audio = Storage::url($audio_post->audio);
    }

    return view('mysound', compact('audio_posts'));
  }

  public function addIndex() {

    return view('forms.add_audio');
  }

  public function add(Request $request) {


    $this->validate($request, [
      'title' => 'required|max:255',
      'artist' => 'required|max:255',
      'album' => 'nullable|max:255',
      'genre' => 'required|max:255',
      'audio' => 'required|mimes:mpga',
      'year' => 'nullable|digits:4',
    ]);

    $extension = Input::file('audio')->getClientOriginalExtension();

    if ($extension == 'mp3') {

      $audio_data = new MP3File($request->audio);

      $request->length = $audio_data->getDuration();
      $request->bitrate = $audio_data->getMP3BitRate();

      if ($request->explicit == "on") {
        $request->explicit = 1;
      }
      else {
        $request->explicit = 0;
      }

      if (file_exists(request()->file('audio'))) {

        $request->audio = request()->file('audio')->store('public/audio');

        //if (file_exists($request->audio)){

          Audio::create([
              'audio' => $request->audio,
              'title' => $request->title,
              'artist' => $request->artist,
              'album' => $request->album,
              'explicit' => $request->explicit,
              'year' => $request->year,
              'length' => $request->length,
              'bitrate' => $request->bitrate,
              'user_id' => Auth::user()->id,
            ]
          );


//        }else{
//          return redirect()->back()->with('message', 'MP3 Bestand niet gevonden');
//        }
      }
      else {
        return redirect()->back()->with('message', 'Er is iets fout gegaan 2');
      }

      return redirect()->back()->with('message', 'Bestand succesvol toegevoegd');
    }

    else {

      return redirect()->back()->with('message', 'Bestandformaat is geen mp3');
    }
  }
}
