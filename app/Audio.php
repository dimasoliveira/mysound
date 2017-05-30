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
    'filename', 'title', 'artist','album_id', 'published', 'coverart',
    'tracknumber','explicit', 'year', 'length', 'bitrate', 'user_id',
    'genre_id',
  ];

  public function likes(){
    return $this->hasMany(Like::class);
  }

  public function comments(){
    return $this->hasMany(Comment::class);
  }

  public function user(){
    return $this->belongsTo(User::class);
  }
  public function album(){
    return $this->belongsTo(Album::class);
  }

  public function playlist(){
    return $this->belongsToMany(Playlist::class,'audio_playlists');
  }

  public function genre(){
    return $this->belongsTo(Genre::class);
  }

}
