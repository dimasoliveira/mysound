<?php

namespace App\Http\Controllers;

use App\Audio;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {
  public function store(Request $request, Audio $audio) {

    $this->validate($request, [
      'comment' => 'required|max:255|min:1',
    ]);

    // Comment create
    Comment::create([
      'text' => $request->comment,
      'audio_id' => $audio->id,
      'user_id' => Auth::user()->id
    ]);

    return redirect()
      ->back();
  }

  public function destroy(Comment $comment) {

    // User mag comment verwijderen als het op zijn post is, of als de user de comment heeft geplaatst
    if ($comment->user_id == Auth::user()->id || $comment->audio->user_id == Auth::user()->id) {
      Comment::where('id', $comment->id)->delete();
    }
    return redirect()->back();
  }
}
