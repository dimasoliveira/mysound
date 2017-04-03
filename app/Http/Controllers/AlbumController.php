<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Album;


class AlbumController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
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


//    VOOR DE GENRES AAN DE LINKERKANT
//    foreach ($album->audio as $song){
//
//        $artist[] = $song->artist;
//
//        $album->artist = array_unique($artist);
//      }



    return view('myaudio.album_show',compact('album'));
  }

}
