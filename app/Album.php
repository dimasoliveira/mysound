<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Album extends Model
{
  use Sluggable;

  protected $fillable = [
    'name', 'artist', 'coverart', 'user_id',
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function audio(){
    return $this->hasMany(Audio::class);
  }

  public function sluggable()
  {
    return [
      'slug' => [
        'source' => 'name'
      ]
    ];
  }

}
