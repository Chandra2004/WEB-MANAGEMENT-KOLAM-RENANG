<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_062413_CreateCategoriesTable {
    public function up()
    {
        Schema::create('categories', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();
            $table->string('nama_kategori');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}