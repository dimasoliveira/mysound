<?php

namespace App\Http\Controllers;

use App\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Album;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');

    // Delete Albums waarvan de album id niet voorkomt in het audio tabel
    // hier verwijderd hij dus albums waar geen audio aan gekoppeld is
    Album::whereNotExists(function($query)
    {
      $query->select(DB::raw(1))
        ->from('audio')->whereRaw('albums.id = audio.album_id');
    })->delete();
  }

  public function getAll() {


    $albums = Album::all()->where('user_id', Auth::user()->id);

    return view('myaudio.albums', compact('albums'));
  }

  public function getAlbum($slug) {

    //$id =\DB::table('albums')->where('user_id', Auth::user()->id)->where('name', $id)->value('id');


    //$album = Album::findOrfail($id);
    $album = Album::where('slug', $slug)->where('user_id',Auth::user()->id)->first();


    if ($album->artist == NULL){
      foreach ($album->audio as $song){

        $artist[] = $song->artist;

        $album->artist = array_unique($artist);
      }
    }

    foreach ($album->audio as $song){

        $year[] = $song->year;
        $genres[] = $song->genre;

        $album->genres = array_unique($genres);
        $album->year = array_unique($year);
      }

    return view('myaudio.album_show',compact('album'));
  }

  public function edit(){

  }

  public function update(Request $request, $slug){

    $current_album = Album::where('slug', $slug)->where('user_id', Auth::user()->id)->first();
    $duplicate_album = Album::where('name', $request->album_name)->where('user_id', Auth::user()->id)->first();

    if (is_null($duplicate_album)){
      $current_album->slug = null;
      $current_album->update(['name' => $request->album_name]);

      return redirect()->intended(route('myaudio.album.show',$current_album->slug));
    }

    else{
      foreach ($current_album->audio as $song){
        $song->update(['album_id' => $duplicate_album->id]);

      }
      return redirect()->intended(route('myaudio.album.show',$duplicate_album->slug));
}

    // Als ingevoerde albumnaam al bestaat
    // Moeten de albums bij elkaar gegooit worden


    // Verplaats liedjes naar nieuwe album
    //Verwijder huidige album

//    $album->name = $request->album_name;
//    $album->save();



  }
}
