<?php

namespace App\Http\Controllers;

use App\Album;
use App\Genre;
use App\Playlist;
use App\Audio;
use App\MP3File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AudioController extends Controller {
  /** Index
   *
   * Haalt de geuploade audio op en zet deze
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */

  public function index() {

    $audio_posts = Audio::orderBy('created_at', 'desc')
      ->where('user_id', Auth::user()->id)->get();
    $playlists = Playlist::orderBy('created_at', 'desc')
      ->where('user_id', Auth::user()->id)->get();

    return view('myaudio.index', compact('audio_posts','playlists'));
  }

  public function create() {

    return view('forms.audio.create',compact('genres'));
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(), [
      'title' => 'required|max:255',
      'artist' => 'required|max:50',
      'album' => 'nullable|max:50',
      'genre' => 'required|integer',
      'coverart' => 'nullable|dimensions:ratio=1/1',
      'filename' => 'required|mimes:mpga',
      'year' => 'nullable|digits:4',
      'tracknumber' => 'nullable|max:99',]);


    if ($validator->fails() || !file_exists(request()->file('filename'))) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->with('audioAddValidationError', 'Adding audio failed')
        ->withInput();
    }
    //Hier wordt gechecked of de gebruiker over zijn uploadlimit heen gaat
    if ($this->uploadLimitCheck(($audioData = new MP3File($request->filename))->getDuration())){
       return redirect()->back()->with('audioAddValidationError', 'Adding audio failed')
         ->with('message', 'No enough space left, Try delete existing songs to free space')
         ->withInput();
     }
        if ($request->coverart !== NULL && file_exists(request()->file('coverart'))) {
          $request->coverart = request()->file('coverart')->store('public/coverarts');
        }
        else{
          $request->coverart = '/defaults/coverart.png';
        }

        //storeAsMP3 slaat het bestand op als MP3 (omdat Laravel dit standaard in mpga doet)
        $audioData->storeAsMP3($request);
        $album = Album::where('name', $request->album)->where('user_id', Auth::user()->id)->first();

        if (empty($album)) {

          $album = Album::create([
            'name' => $request->album,
            'user_id' => Auth::user()->id,
            'coverart' => $request->coverart,
          ]);

        }

        Audio::create([
            'filename' => $request->filename,
            'title' => $request->title,
            'artist' => $request->artist,
            'album_id' => $album->id,
            'tracknumber' => $request->tracknumber,
            'published' => $request->published == 'on' ? 1 : 0,
            'genre_id' => $request->genre,
            'explicit' => $request->explicit == 'on' ? 1 : 0,
            'year' => $request->year,
            'length' => $audioData->getDuration(),
            'bitrate' => $audioData->getMP3BitRate(),
            'coverart' => $request->coverart,
            'user_id' => Auth::user()->id,
          ]
        );

        return redirect()->back()->with('message', 'Song succesfully added');
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
      'genre' => 'required|integer',
      'coverart' => 'nullable|dimensions:ratio=1/1',
      'year' => 'nullable|digits:4',
      'tracknumber' => 'nullable|max:99',
    ]);

    if ($validator->fails()) {
      return redirect()
        ->back()
        ->withErrors($validator)
        ->with('audioEditValidationError', 'Editing audio failed'.$request->id)
        ->withInput();
    }

    if ($request->coverart !== NULL && file_exists(request()->file('coverart'))) {

      //slaat de coverart op als die in de inputform is meegegeven
      $audio->coverart = request()->file('coverart')->store('public/coverarts');

      // als er een bestaande is en de nieuwe coverart bestaat dan word die opgeslagen
      if (Storage::exists($audio->coverart) && Storage::exists($request->coverart)){
        Storage::delete($audio->coverart);
      }

    }
    else {
      $request->coverart = $audio->coverart;
    }
    // checkt of het album al bestaat
    $request->album_id = Album::where('name', $request->album)
      ->where('user_id', Auth::user()->id)
      ->value('id');

    //zoniet, dan maakt hij een nieuwe aan en paast hij de id door
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
      $audio->explicit = $request->explicit == 'on' ? 1 : 0;
      $audio->published = $request->published == 'on' ? 1 : 0;
      $audio->year = $request->year;
      $audio->genre_id = $request->genre;
      $audio->save();

    return redirect()
      ->back()
      ->with('message', 'Song succesfully edited');
  }

  /** Destroy
   *
   * Verwijderen van opgevraagde audio
   * @param \App\Audio $audio
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Audio $audio)
  {

    if (!Storage::exists($audio->filename)){
      return redirect()
        ->back()
        ->with('message', 'Something went wrong, try again');
    }

    //checkt of hij nog gelinkt is met afspeellijsten en verwijderd die
    if (DB::table('audio_playlists')->where('id', $audio->id)->exists()){
    DB::table('audio_playlists')->where('id', $audio->id)->delete();
    }

    Storage::delete($audio->filename);

    if (Storage::exists($audio->coverart)){
      Storage::delete($audio->coverart);
    }

    $audio->delete();

      return redirect()
        ->back()
        ->with('message', 'Succesfully delete audio');
  }

  /** uploadLimitCheck
   *
   * Checkt of user aan zijn upload limit zit bij het uploaden van het bestand
   * @param $durationCurrent
   *
   * @return bool
   */
  public function uploadLimitCheck($durationCurrent) {

    foreach (Auth::user()->audio as $audio){
      $totalUploadSeconds[] = $audio->length;
    }
    $totalUploadSeconds[] = $durationCurrent;
    return array_sum($totalUploadSeconds) >= Auth::user()->upload_limit;
  }
}
