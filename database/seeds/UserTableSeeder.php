<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = User::create([
        'username' => 'dimas1998',
        'firstname' => 'Dimas',
        'lastname' => 'Oliveira',
        'email' => 'd.oliveira@live.nl',
        'password' => bcrypt('password'),
        'birthdate' => '03-02-1998',]);

      $user->attachRole(Role::where('name','admin')->first()->id);

    }
}
