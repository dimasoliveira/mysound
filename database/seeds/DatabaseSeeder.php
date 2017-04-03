<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Genre;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      Role::create([
        'name'=> 'admin',
      ]);

      Role::create([
        'name'=> 'user',
      ]);

      User::create([
        'username' => 'dimas1998',
        'firstname' => 'Dimas',
        'lastname' => 'Oliveira',
        'email' => 'd.oliveira@live.nl',
        'password' => bcrypt('password'),
        'birthdate' => '3-2-1998',
        'role_id' => 1,
      ]);

      $genres = [ "Blues","Classic Rock","Country","Dance","Disco","Funk","Grunge","Hip-Hop","Jazz",
        "Metal","New Age","Oldies","Other","Pop","R&B","Rap","Reggae",
        "Rock","Techno","Industrial","Alternative","Ska","Death Metal","Pranks","Soundtrack",
        "Euro-Techno","Ambient","Trip-Hop","Vocal","Jazz+Funk","Fusion","Trance",
        "Classical","Instrumental","Acid","House","Game","Sound Clip","Gospel","Noise","AlternRock",
        "Bass","Soul","Punk","Space","Meditative","Instrumental Pop","Instrumental Rock","Ethnic",
        "Gothic","Darkwave","Techno-Industrial","Electronic","Pop-Folk","Eurodance","Dream",
        "Southern Rock","Comedy","Cult","Gangsta","Top 40","Christian Rap","Pop/Funk","Jungle",
        "Native American","Cabaret","New Wave","Psychedelic","Rave","Showtunes","Trailer","Lo-Fi","Tribal",
        "Acid Punk","Acid Jazz","Polka","Retro","Musical","Rock & Roll","Hard Rock","Folk","Folk-Rock",
        "National Folk","Swing","Fast Fusion","Bebop","Latin","Revival","Celtic","Bluegrass","Avantgarde",
        "Gothic Rock","Progressive Rock","Psychedelic Rock","Symphonic Rock","Slow Rock","Big Band","Chorus",
        "Easy Listening","Acoustic","Humor","Speech","Chanson","Opera","Chamber Music","Sonata","Symphony",
        "Booty Bass","Primus","Porn Groove","Satire","Slow Jam","Club","Tango","Samba","Folklore","Ballad",
        "Power Ballad","Rhythmic Soul","Freestyle","Duet","Punk Rock","Drum Solo","A Capella","Euro-House","Dance Hall",
      ];

      foreach($genres as $genre) {
        Genre::create([
          'name' => $genre,
        ]);
      }
    }
}
