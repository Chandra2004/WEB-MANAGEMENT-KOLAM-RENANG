<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_062541_CreateResetTokenTable {
    public function up()
    {
        Schema::create('reset_token', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();
            $table->string('email')->nullable();
            $table->string('token');
            $table->string('valid_until');
            $table->timestamp('create_at');
            
            $table->timestamps();

            $table->foreign('email')->references('uid')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reset_token');
    }
}