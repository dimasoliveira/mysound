<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
  public function create(Audio $audio) {

    if (Like::where('user_id', Auth::user()->id)
      ->where('audio_id', $audio->id)
      ->exists()

  ) {
      Like::where('user_id', Auth::user()->id)
        ->where('audio_id', $audio->id)
        ->delete();
      return redirect()
        ->back();
    }
    else {

      Like::insert([
        'audio_id' => $audio->id,
        'user_id' => Auth::user()->id
      ]);

      return redirect()
        ->back();
    }
  }
}
