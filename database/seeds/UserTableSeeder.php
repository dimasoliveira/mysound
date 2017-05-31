<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Faker\Factory as Faker;

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
        'birthdate' => '1998-03-02',]);

      $user->attachRole(Role::where('name','admin')->first()->id);

      $faker = Faker::create();
      foreach (range(1,10) as $index) {

        $user = User::create([

          'username' => $faker->username,
          'firstname' => $faker->name,
          'lastname' => $faker->lastName,
          'email' => $faker->email,
          'password' => bcrypt('password'),
          'birthdate' => '1998-03-02',

        ]);
        $user->attachRole(Role::where('name','user')->first()->id);

      }

    }
}
