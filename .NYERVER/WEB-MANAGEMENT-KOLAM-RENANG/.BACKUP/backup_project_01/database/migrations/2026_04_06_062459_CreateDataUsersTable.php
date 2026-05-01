<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_062459_CreateDataUsersTable {
    public function up()
    {
        Schema::create('data_users', function ($table) {
            $table->increments('id');
            $table->string('uid', 36)->unique();
            $table->string('uid_user', 36);
            $table->string('nama_lengkap');        
            $table->string('no_telepon');
            $table->date('tanggal_lahir');
            $table->varchar('jenis_kelamin');
            $table->string('uid_klub', 36);
            $table->string('foto_profil');            
            $table->string('foto_akta');            
            $table->string('foto_ktp');
            $table->boolean('is_active');            

            $table->timestamps();

            $table->foreign('uid_user')->references('uid')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('uid_club')->references('uid')->on('clubs')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_users');
    }
}