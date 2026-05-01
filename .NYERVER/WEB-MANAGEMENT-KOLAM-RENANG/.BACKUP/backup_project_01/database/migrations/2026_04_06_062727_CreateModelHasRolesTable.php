<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_062727_CreateModelHasRolesTable {
    public function up()
    {
        Schema::create('model_has_roles', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();
            $table->string('role_uid', 36);
            $table->string('model_uid', 36);
            $table->string('model_type');
            
            $table->timestamps();

            $table->foreign('roles_uid')->references('uid')->on('roles')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('model_uid')->references('uid')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('model_has_roles');
    }
}