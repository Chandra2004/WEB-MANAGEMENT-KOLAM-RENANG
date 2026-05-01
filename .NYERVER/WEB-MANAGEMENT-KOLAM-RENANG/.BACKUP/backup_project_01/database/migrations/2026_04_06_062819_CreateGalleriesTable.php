<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_062819_CreateGalleriesTable {
    public function up()
    {
        Schema::create('galleries', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('galleries');
    }
}