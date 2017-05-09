<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioGenres extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'audio_id', 'genre_id',
  ];

  public function audio(){
    return $this->belongsTo(Audio::class);
  }
//  public function genre(){
//    return $this->belongsTo(Genre::class);
//
//  }

}
