<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_063014_CreateCategoryRequirementsTable {
    public function up()
    {
        Schema::create('category_requirements', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();
            $table->string('uid_event_category', 36)->unique();
            $table->string('parameter_name', 255);
            $table->string('parameter_value', 255);
            $table->string('operator', 255);

            $table->timestamps();

            $table->foreign('uid_event_category')->references('uid')->on('event_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_requirements');
    }
}