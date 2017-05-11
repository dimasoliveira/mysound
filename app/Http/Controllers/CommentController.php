<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
  public function create(Request $request,Audio $audio){

    Validator::make($request->all(), [
      'comment' => 'required|max:255|min:1',
    ])->validate();

    Comment::create([
      'text' => $request->comment,
      'audio_id' => $audio->id,
      'user_id' => Auth::user()->id
    ]);

    return redirect()
      ->back();

  }

  public function destroy(Comment $comment){

    if ($comment->user_id == Auth::user()->id || $comment->audio->user_id == Auth::user()->id){
      Comment::where('id', $comment->id)->delete();
    }
    return redirect()
      ->back();
  }
}
