<?php

namespace App\Http\Controllers;

use App\Album;
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

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index() {



//    dd($audio = Audio::findOrfail(1));

      $audio_posts = Audio::all()->where('user_id', Auth::user()->id);

      foreach ($audio_posts as $audio_post) {

        $audio_post->filename = Storage::url($audio_post->filename);
      }

      return view('myaudio.recent', compact('audio_posts'));
  }

  public function addForm() {



    return view('forms.add_audio');
  }

  public function add(Request $request) {




    $this->validate($request, [
        'title' => 'required|max:255',
        'artist' => 'required|max:255',
        'album' => 'nullable|max:255',
        'genre' => 'required|max:255',
        'filename' => 'required|mimes:mpga',
        'year' => 'nullable|digits:4',
      ]);

      $extension = Input::file('filename')->getClientOriginalExtension();

      if ($extension == 'mp3') {

        $audio_data = new MP3File($request->filename);

        $request->length = $audio_data->getDuration();
        $request->bitrate = $audio_data->getMP3BitRate();

        if ($request->explicit == "on") {
          $request->explicit = 1;
        }
        else {
          $request->explicit = 0;
        }

        if ($request->private == "on") {
          $request->private = 1;
        }
        else {
          $request->private = 0;
        }

        if ($request->published == "on") {
          $request->published = 1;
        }
        else {
          $request->published = 0;
        }



        if (file_exists(request()->file('filename'))) {

          $request->filename = request()
            ->file('filename')
            ->store('public/audio');

          //if (file_exists($request->filename)){
          //\DB::table('albums')->where('role_name', 'user')->value('role_id');

          //check if album exists
          $album_id = \DB::table('albums')->where('name', $request->album)->value('id');

          //if not, create the album and pass the album id
            if ($album_id === null) {

             Album::create([
                  'name' => $request->album,
                  'user_id' => Auth::user()->id,
                ]);

                $album_id =\DB::getPdo()->lastInsertId();
                }


          Audio::create([
              'filename' => $request->filename,
              'title' => $request->title,
              'artist' => $request->artist,
              'album_id' => $album_id,
              'private' => $request->private,
              'published' => $request->published,
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
          return redirect()
            ->back()
            ->with('message', 'Er is iets fout gegaan 2');
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


}
