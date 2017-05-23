<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',25)->unique();
            $table->string('firstname',50);
            $table->string('lastname',50);
            $table->date('birthdate');
            $table->string('email',100)->unique();
            $table->string('password');
            $table->string('avatar');
            $table->integer('upload_limit')->default(10800);
            $table->string('slug')->nullable()->unique();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
