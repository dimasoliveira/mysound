<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AudioController extends Controller
{

  public function index()
  {

    return view('forms.add_audio');
  }

  public function add(Request $request)
  {
    dd($request);
    return view('forms.add_audio');
  }

  protected function validator(array $data)
  {
    return Validator::make($data, [
      'title' => 'required|max:255',
      'artist' => 'required|max:255',
      'album' => 'nullable|max:255',
      'genre' => 'required|max:255',
      'file' => 'required|max:255',
      'year' => 'nullable|max:255',

    ]);
  }


}
