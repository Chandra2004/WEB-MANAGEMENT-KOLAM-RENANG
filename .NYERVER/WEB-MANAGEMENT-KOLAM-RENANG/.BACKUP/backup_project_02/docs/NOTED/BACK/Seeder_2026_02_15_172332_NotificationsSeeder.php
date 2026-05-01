<?php

namespace Database\Seeders;

use Faker\Factory;
use TheFramework\Database\Seeder;
use TheFramework\Helpers\Helper;
use TheFramework\Models\User;

class Seeder_2026_02_15_172332_NotificationsSeeder extends Seeder {

    public function run() {
        $faker = Factory::create();
        Seeder::setTable('notifications');

        Seeder::create([
            [
                // Contoh data:
                'uid' => Helper::uuid(),
                'uid_user' => User::all()[0]['uid'],
                'judul' => $faker->title,
                'pesan' => $faker->text,
                'is_read' => 0,
            ],
            [
                // Contoh data:
                'uid' => Helper::uuid(),
                'uid_user' => User::all()[1]['uid'],
                'judul' => $faker->title,
                'pesan' => $faker->text,
                'is_read' => 0,
            ],
            [
                // Contoh data:
                'uid' => Helper::uuid(),
                'uid_user' => User::all()[2]['uid'],
                'judul' => $faker->title,
                'pesan' => $faker->text,
                'is_read' => 0,
            ]
        ]);
    }
}
