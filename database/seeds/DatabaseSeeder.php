<?php

use Illuminate\Database\Seeder;
use App\Role;
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
      $this->call(PermissionTableSeeder::class);
      $this->call(UserTableSeeder::class);
      $this->call(GenreTableSeeder::class);

    }
}
