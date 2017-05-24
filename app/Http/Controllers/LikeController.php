<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller {
  public function create(Audio $audio) {

    // Check of de post al door de user is geliked
    if (Like::where('user_id', Auth::user()->id)
      ->where('audio_id', $audio->id)
      ->exists()
    ) {
    // Als post al is geliked, wordt die weer unliked
      Like::where('user_id', Auth::user()->id)
        ->where('audio_id', $audio->id)
        ->delete();
      return redirect()
        ->back();
    }
    // Als post nog niet geliked is, wordt de like toegevoegd
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
