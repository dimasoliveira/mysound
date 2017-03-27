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
  protected $primaryKey = 'audio_id';

  protected $fillable = [
    'filename', 'title', 'artist','album_id',
    'explicit', 'year', 'length', 'bitrate', 'user_id',
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }
  public function album(){
    return $this->belongsTo(Album::class);
  }

}
