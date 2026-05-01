<?php

namespace Database\Seeders;

use Faker\Factory;
use TheFramework\Database\Seeder;
use TheFramework\Helpers\Helper;
use TheFramework\Models\Event;
use TheFramework\Models\User;

class Seeder_2026_02_15_172447_RegistrationsSeeder extends Seeder {

    public function run() {
        $faker = Factory::create();
        Seeder::setTable('registrations');

        Seeder::create([
            [
                'uid' => Helper::uuid(),
                'uid_user' => User::all()[0]['uid'],
                'uid_event' => Event::all()[0]['uid'],
                'status' => 'menunggu',
                'tanggal_registrasi' => $faker->date,
            ],
            [
                'uid' => Helper::uuid(),
                'uid_user' => User::all()[1]['uid'],
                'uid_event' => Event::all()[1]['uid'],
                'status' => 'diterima',
                'tanggal_registrasi' => $faker->date,
            ],
            [
                'uid' => Helper::uuid(),
                'uid_user' => User::all()[1]['uid'],
                'uid_event' => Event::all()[1]['uid'],
                'status' => 'ditolak',
                'tanggal_registrasi' => $faker->date,
            ],
            [
                'uid' => Helper::uuid(),
                'uid_user' => User::all()[2]['uid'],
                'uid_event' => Event::all()[2]['uid'],
                'status' => 'menunggu',
                'tanggal_registrasi' => $faker->date,
            ]
        ]);
    }
}
