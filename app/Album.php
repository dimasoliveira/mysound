<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
  protected $primaryKey = 'album_id';

  protected $fillable = [
    'name', 'artist', 'coverart', 'user_id',
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function audio(){
    return $this->hasMany(Audio::class);
  }
}
