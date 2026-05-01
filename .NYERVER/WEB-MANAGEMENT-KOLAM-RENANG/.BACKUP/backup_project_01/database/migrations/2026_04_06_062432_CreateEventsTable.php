<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_062432_CreateEventsTable {
    public function up()
    {
        Schema::create('events', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();
            $table->string('nama_event');
            $table->string('lokasi');
            $table->string('status');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}