<?php

namespace App\Http\Controllers;

use App\Audio;
use Illuminate\Support\Facades\Auth;


class TimelineController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        foreach (Auth::user()->followings as $following){
          $followinglist[] = $following->id;
        }

        $followinglist[] = Auth::user()->id;

      // dd($followings = Auth::user()->followings);
        $posts = Audio::whereIn('user_id',$followinglist)->where('published', 1)->orderBy('created_at','desc')->get();
        //Audio::orderBy('created_at','asc')->whereIn('user_id',$followinglist)->get();
        //dd(Audio::all()->whereIn('user_id',$followinglist)->where('published', 1));

        return view('timeline',compact('posts'));
    }
}
