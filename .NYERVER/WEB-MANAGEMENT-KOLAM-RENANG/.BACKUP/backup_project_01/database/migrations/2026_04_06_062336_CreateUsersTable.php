<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_062336_CreateUsersTable {
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();
            $table->string('username');
            $table->string('email');
            $table->string('password');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}