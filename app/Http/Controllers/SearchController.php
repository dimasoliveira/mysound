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

    $audio_results = Audio::where('title','LIKE','%'.$request->search.'%')->orWhere('artist','LIKE','%'.$request->search.'%')->where('published',1)->get();
    $user_results =  User::where('username','LIKE','%'.$request->search.'%')->orWhere('firstname','LIKE','%'.$request->search.'%')->orWhere('lastname','LIKE','%'.$request->search.'%')->get();

    //dd(!$audio_results->isEmpty());

    if ($audio_results->isEmpty()){
      $audio_results = NULL;
    }

    if ($user_results->isEmpty()){
        $user_results = NULL;
      }

    return view('search',compact('audio_results','user_results'));
    }
}
