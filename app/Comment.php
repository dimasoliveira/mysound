<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = [
    'comment_text', 'audio_id', 'user_id',
  ];

  public function user(){
    return $this->belongsTo(User::class);

  }

  public function audio(){
    return $this->belongsTo(Audio::class);

  }
}
