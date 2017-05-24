<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $superadmin = new Role();
      $superadmin->name         = 'super-admin';
      $superadmin->display_name = 'Super Administrator';
      $superadmin->description  = 'User is allowed to do and see everything on the application'; // optional
      $superadmin->save();

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
      $uploadAudio->name         = 'audio-upload';
      $uploadAudio->display_name = 'Upload Audio';
// Allow a user to...
      $uploadAudio->description  = 'upload new audiofiles with metadata';
      $uploadAudio->save();

      $editAudio = new Permission();
      $editAudio->name         = 'audio-edit';
      $editAudio->display_name = 'Edit Audiodata';
// Allow a user to...
      $editAudio->description  = 'edit the metadata from an audioposts';
      $editAudio->save();

      $deleteAudio = new Permission();
      $deleteAudio->name         = 'audio-delete';
      $deleteAudio->display_name = 'Delete Audio';
// Allow a user to...
      $deleteAudio->description  = 'delete a audiofiles with the attached metadata';
      $deleteAudio->save();

      $deleteUser = new Permission();
      $deleteUser->name         = 'user-delete';
      $deleteUser->display_name = 'Delete Users';
// Allow a user to...
      $deleteUser->description  = 'delete existing users';
      $deleteUser->save();

      $editUser = new Permission();
      $editUser->name         = 'user-edit';
      $editUser->display_name = 'Edit Users';
// Allow a user to...
      $editUser->description  = 'edit existing users';
      $editUser->save();

      $followUser = new Permission();
      $followUser->name         = 'user-follow';
      $followUser->display_name = 'Follow Users';
// Allow a user to...
      $followUser->description  = 'follow other users';
      $followUser->save();

      $createRole = new Permission();
      $createRole->name         = 'role-create';
      $createRole->display_name = 'Create Roles';
// Allow a user to...
      $createRole->description  = 'create new roles';
      $createRole->save();

      $editRole = new Permission();
      $editRole->name         = 'role-edit';
      $editRole->display_name = 'Edit Roles';
// Allow a user to...
      $editRole->description  = 'edit existing roles';
      $editRole->save();

      $uploadLimitEdit = new Permission();
      $uploadLimitEdit->name         = 'uploadlimit-edit';
      $uploadLimitEdit->display_name = 'Edit User Upload Limit';
// Allow a user to...
      $uploadLimitEdit->description  = 'edit the upload limit for all/one user';
      $uploadLimitEdit->save();

      $showLogs = new Permission();
      $showLogs->name         = 'log-show';
      $showLogs->display_name = 'Show Logs';
// Allow a user to...
      $showLogs->description  = 'access to the logs from the behavior and activity of the users';
      $showLogs->save();

      $superadmin->attachPermissions([$uploadAudio, $editAudio, $deleteAudio, $editUser, $deleteUser, $showLogs, $editRole, $createRole, $followUser,$uploadLimitEdit]);
      $admin->attachPermissions([$uploadAudio, $editAudio, $deleteAudio, $editUser, $deleteUser, $showLogs, $editRole,$createRole,$followUser,$uploadLimitEdit]);
      $user->attachPermissions([$uploadAudio, $followUser, $editAudio, $deleteAudio]);
      $partner->attachPermissions([$uploadAudio, $editAudio, $deleteAudio, $editUser, $deleteUser, $showLogs]);


// equivalent to $admin->perms()->sync(array($createPost->id));
    }
}
