<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'audio', 'title', 'artist', 'album', 'genre',
    'explicit', 'year', 'length', 'bitrate', 'user_id',
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }
}
