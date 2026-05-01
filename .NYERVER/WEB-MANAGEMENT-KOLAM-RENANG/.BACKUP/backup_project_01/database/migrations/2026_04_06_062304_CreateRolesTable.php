<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_062304_CreateRolesTable {
    public function up()
    {
        Schema::create('roles', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();

            $table->string('name')->unique();
            $table->string('guard_name')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}