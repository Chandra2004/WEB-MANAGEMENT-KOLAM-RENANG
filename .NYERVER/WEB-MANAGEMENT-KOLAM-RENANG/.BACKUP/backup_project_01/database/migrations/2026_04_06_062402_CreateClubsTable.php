<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_062402_CreateClubsTable {
    public function up()
    {
        Schema::create('clubs', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();
            $table->string('nama_klub');
            $table->string('logo_klub');
            $table->string('nama_pelatih');
            $table->string('kontak_klub');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clubs');
    }
}