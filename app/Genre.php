<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
  protected $fillable = [
    'genre_name',
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }
}
