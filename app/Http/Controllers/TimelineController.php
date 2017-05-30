<?php

namespace App\Http\Controllers;

use App\Audio;
use Illuminate\Support\Facades\Auth;


class TimelineController extends Controller
{
  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   *
   * Onderstaande functie haalt alle audio van users op die de gebruiker volgt
   */
    public function index()
    {
        foreach (Auth::user()->followings as $following){
          $followinglist[] = $following->id;
        }

        $followinglist[] = Auth::user()->id;

        $posts = Audio::whereIn('user_id',$followinglist)->where('published', 1)->orderBy('created_at','desc')->get();

        return view('timeline.index',compact('posts'));
    }

    public function show($slug,Audio $audio){

      return view('timeline.show',compact('audio'));
    }
}
