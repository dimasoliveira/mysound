<?php

use Illuminate\Database\Seeder;
use App\Genre;
class GenreSeeder extends Seeder{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $genres = ['Jazz', 'Blues',
      'Folk', 'Hip-Hop', 'Rock', 'Classical', 'Funk', 'Pop', 'Reggae', 'Rapping', 'Ambient', 'Techno',
      'Rhythm & Blues', 'Country', 'Instrumental', 'Punk Rock', 'Electronic Dance', 'Classical', 'Melody',
      'Dubstep', 'Disco', 'Singing', 'Orchestra', 'Opera', 'Alternative Rock', 'House', 'Soul', 'Trance',
      'Popular', 'Heavy Metal', 'Gospel', 'Drum & Bass', 'Ska', 'Electropop', 'Electro', 'Trap', 'Bluegrass',
      'Grunge', 'New Wave', 'Jazz Fusion', 'Electronica', 'Psychedelic', 'Blues Rock', 'Hard Rock', 'Trip-Hop', 'Big Band',
      'Death metal', 'Hardcore punk', 'New-age', 'Progressive Rock', 'Reggaeton',
     ];

    foreach($genres as $genre){
      Genre::create([
        'genre_name' => $genre,
      ]);
    };
  }
}