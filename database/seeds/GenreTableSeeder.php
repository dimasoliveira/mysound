<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $genres = ['Blues','Comedy','Children’s Music','Classical','Country','Electronic','Holiday','Opera','Singer/Songwriter','Jazz','Latino','New Age','Pop','R&B/Soul','Soundtrack','Dance','Hip-Hop/Rap','World','Alternative','Rock','Christian & Gospel','Vocal','Reggae','Easy Listening','J-Pop','Enka','Anime','Kayokyoku','Fitness & Workout','K-Pop','Karaoke','Instrumental','Brazilian','Spoken Word','Disney','French Pop','German Pop','German Folk',];

      foreach ($genres as $genre){
        Genre::create([
          'name' => $genre,
        ]);
      }
    }
}
