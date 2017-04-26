<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Genre;
use App\User;
use App\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $admin = new Role();
      $admin->name         = 'admin';
      $admin->display_name = 'Administrator';
      $admin->description  = 'User is allowed to manage and edit other users and all the other content on the application'; // optional
      $admin->save();

      $user = new Role();
      $user->name         = 'user';
      $user->display_name = 'Application User';
      $user->description  = 'User is allowed to upload and listen to audio';
      $user->save();

      $partner = new Role();
      $partner->name         = 'partner';
      $partner->display_name = 'Business Partner';
      $partner->description  = 'User is allowed to get access to the user';
      $partner->save();



      $uploadAudio = new Permission();
      $uploadAudio->name         = 'upload-audio';
      $uploadAudio->display_name = 'Upload Audio';
// Allow a user to...
      $uploadAudio->description  = 'upload new audiofiles with metadata';
      $uploadAudio->save();

      $editAudio = new Permission();
      $editAudio->name         = 'edit-audio';
      $editAudio->display_name = 'Edit Audiodata'; // optional
// Allow a user to...
      $editAudio->description  = 'edit the metadata from an audioposts';
      $editAudio->save();

      $deleteAudio = new Permission();
      $deleteAudio->name         = 'delete-audio';
      $deleteAudio->display_name = 'Delete Audio';
// Allow a user to...
      $deleteAudio->description  = 'delete a audiofiles with the attached metadata';
      $deleteAudio->save();

      $deleteUser = new Permission();
      $deleteUser->name         = 'delete-user';
      $deleteUser->display_name = 'Delete Users';
// Allow a user to...
      $deleteUser->description  = 'delete existing users';
      $deleteUser->save();

      $editUser = new Permission();
      $editUser->name         = 'edit-user';
      $editUser->display_name = 'Edit Users';
// Allow a user to...
      $editUser->description  = 'edit existing users';
      $editUser->save();

      $showLogs = new Permission();
      $showLogs->name         = 'show-logs';
      $showLogs->display_name = 'Show Logs';
// Allow a user to...
      $showLogs->description  = 'access to the logs from the behavior and activity of the users';
      $showLogs->save();


      $admin->attachPermissions([$uploadAudio, $editAudio, $deleteAudio, $editUser, $deleteUser, $showLogs]);
      $user->attachPermissions([$uploadAudio]);
      $partner->attachPermissions([$uploadAudio, $editAudio, $deleteAudio, $editUser, $deleteUser, $showLogs]);
// equivalent to $admin->perms()->sync(array($createPost->id));

      $userinsert = User::create([
        'username' => 'dimas1998',
        'firstname' => 'Dimas',
        'lastname' => 'Oliveira',
        'email' => 'd.oliveira@live.nl',
        'password' => bcrypt('password'),
        'birthdate' => '3-2-1998',]);

      $userinsert->attachRole(Role::where('name','user')->first()->id);

//      $genres = [ "Blues","Classic Rock","Country","Dance","Disco","Funk","Grunge","Hip-Hop","Jazz", "Metal","New Age","Oldies","Other","Pop","R&B","Rap","Reggae", "Rock","Techno","Industrial","Alternative","Ska","Death Metal","Pranks","Soundtrack", "Euro-Techno","Ambient","Trip-Hop","Vocal","Jazz+Funk","Fusion","Trance", "Classical","Instrumental","Acid","House","Game","Sound Clip","Gospel","Noise","AlternRock", "Bass","Soul","Punk","Space","Meditative","Instrumental Pop","Instrumental Rock","Ethnic", "Gothic","Darkwave","Techno-Industrial","Electronic","Pop-Folk","Eurodance","Dream", "Southern Rock","Comedy","Cult","Gangsta","Top 40","Christian Rap","Pop/Funk","Jungle", "Native American","Cabaret","New Wave","Psychedelic","Rave","Showtunes","Trailer","Lo-Fi","Tribal", "Acid Punk","Acid Jazz","Polka","Retro","Musical","Rock & Roll","Hard Rock","Folk","Folk-Rock", "National Folk","Swing","Fast Fusion","Bebop","Latin","Revival","Celtic","Bluegrass","Avantgarde", "Gothic Rock","Progressive Rock","Psychedelic Rock","Symphonic Rock","Slow Rock","Big Band","Chorus", "Easy Listening","Acoustic","Humor","Speech","Chanson","Opera","Chamber Music","Sonata","Symphony", "Booty Bass","Primus","Porn Groove","Satire","Slow Jam","Club","Tango","Samba","Folklore","Ballad", "Power Ballad","Rhythmic Soul","Freestyle","Duet","Punk Rock","Drum Solo","A Capella","Euro-House","Dance Hall",];

    }
}
