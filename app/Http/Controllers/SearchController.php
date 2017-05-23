<?php

namespace App\Http\Controllers;

use App\Audio;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){
      return view('search');
    }

    public function searchRequest(Request $request){

    $audios = Audio::where('title','LIKE','%'.$request->search.'%')->orWhere('artist','LIKE','%'.$request->search.'%')->where('published',1)->get();
    $users =  User::where('username','LIKE','%'.$request->search.'%')->orWhere('firstname','LIKE','%'.$request->search.'%')->orWhere('lastname','LIKE','%'.$request->search.'%')->get();

    //dd(!$audio_results->isEmpty());

    if ($audios->isEmpty()){
      $audios = NULL;
    }

    if ($users->isEmpty()){
        $users = NULL;
      }

    return view('search',compact('audios','users','request'));
    }
}
