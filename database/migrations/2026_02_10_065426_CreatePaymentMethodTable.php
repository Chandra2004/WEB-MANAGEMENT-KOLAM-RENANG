<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_02_10_065426_CreatePaymentMethodTable {
    public function up()
    {
        Schema::create('payment_method', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();
            
            $table->string('bank');
            $table->string('rekening');
            $table->string('atas_nama');
            $table->string('photo');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_method');
    }
}