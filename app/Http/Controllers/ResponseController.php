<?php

namespace App\Http\Controllers;

use App\Audio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResponseController extends Controller
{
  public function likeRequest(Audio $audio) {

    if (DB::table('likes')
      ->where('user_id', Auth::user()->id)
      ->where('audio_id', $audio->id)
      ->exists()

  ) {
      DB::table('likes')
        ->where('user_id', Auth::user()->id)
        ->where('audio_id', $audio->id)
        ->delete();



      return redirect()
        ->back();
    }
    else {

      DB::table('likes')->insert([
        'audio_id' => $audio->id,
        'user_id' => Auth::user()->id
      ]);

      return redirect()
        ->back();
    }
  }
}
