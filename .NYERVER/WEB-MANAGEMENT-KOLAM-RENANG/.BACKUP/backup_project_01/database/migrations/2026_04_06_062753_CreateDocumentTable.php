<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_062753_CreateDocumentTable
{
    public function up()
    {
        Schema::create('document', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();
            $table->string('uid_event', 36)->unique();
            $table->string('logo_organisator', 255);
            $table->string('logo_event', 255);

            $table->timestamps();

            $table->foreign('uid_event')->references('uid')->on('events')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('document');
    }
}
