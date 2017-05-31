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

  /** searchRequest
   *
   * searchRequest zoekt naar audio en users die matchen met de ingevoerde zoekopdracht
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   *
   */
    public function searchRequest(Request $request){

    $audios = Audio::where('title','LIKE','%'.$request->search.'%')->orWhere('artist','LIKE','%'.$request->search.'%')->where('published',1)->get();
    $users =  User::where('username','LIKE','%'.$request->search.'%')->orWhere('firstname','LIKE','%'.$request->search.'%')->orWhere('lastname','LIKE','%'.$request->search.'%')->get();

    $audios->isEmpty() ? $audios = NULL: false;
    $users->isEmpty() ? $users = NULL: false;

    return view('search',compact('audios','users','request'));
    }
}
