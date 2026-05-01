<?php

namespace Database\Migrations;

use TheFramework\App\Schema;

class Migration_2026_04_06_062658_CreateRoleHasPermissionsTable {
    public function up()
    {
        Schema::create('role_has_permissions', function ($table) {  
            $table->string('permission_uid', 36);
            $table->string('role_uid', 36);
            
            $table->timestamps();

            $table->foreign('roles_uid')->references('uid')->on('roles')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('permission_uid')->references('uid')->on('permissions')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_has_permissions');
    }
}