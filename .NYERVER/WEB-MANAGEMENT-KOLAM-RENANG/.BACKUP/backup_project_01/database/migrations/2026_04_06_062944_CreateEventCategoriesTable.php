<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_062944_CreateEventCategoriesTable {
    public function up()
    {
        Schema::create('event_categories', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();
            $table->string('uid_event', 36);
            $table->string('uid_category', 36);
            $table->int('nomor_acara');
            $table->date('tanggal_mulai');
            $table->time('waktu_mulai');
            $table->string('tipe_biaya');
            $table->decimal('biaya_pendaftaran');

            $table->timestamps();

            $table->foreign('uid_event')->references('uid')->on('events')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('uid_category')->references('uid')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_categories');
    }
}