<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_063320_CreatePaymentsTable {
    public function up()
    {
        Schema::create('payments', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();
            $table->string('uid_registration', 36)->unique();
            $table->string('nomor_invoice', 36);
            $table->decimal('total_bayar');
            $table->string('status_pembayaran', 36);
            $table->timestamps();

            $table->foreign('uid_registration')->references('uid')->on('registrations')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}