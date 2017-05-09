<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
  protected $fillable = [
    'name','user_id','description',
  ];

  public function audio(){
    return $this->belongsToMany(Audio::class,'audio_playlists');
  }

}
