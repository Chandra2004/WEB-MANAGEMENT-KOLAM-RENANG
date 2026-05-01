<?php

namespace Database\Seeders;

use Faker\Factory;
use TheFramework\Database\Seeder;
use TheFramework\Helpers\Helper;
use TheFramework\Models\Registration;

class Seeder_2026_02_15_172501_PaymentsSeeder extends Seeder {

    public function run() {
        $faker = Factory::create();
        Seeder::setTable('payments');

        Seeder::create([
            [
                // Contoh data:
                'uid' => Helper::uuid(),
                'uid_registration' => Registration::all()[0]['uid'],
                'metode_pembayaran' => $faker->city,
                'status_pembayaran' => 'menunggu',
                'tanggal_pembayaran' => $faker->date,
                'bukti_pembayaran' => $faker->name
            ],
            [
                // Contoh data:
                'uid' => Helper::uuid(),
                'uid_registration' => Registration::all()[1]['uid'],
                'metode_pembayaran' => $faker->city,
                'status_pembayaran' => 'menunggu',
                'tanggal_pembayaran' => $faker->date,
                'bukti_pembayaran' => $faker->name
            ],
            [
                // Contoh data:
                'uid' => Helper::uuid(),
                'uid_registration' => Registration::all()[2]['uid'],
                'metode_pembayaran' => $faker->city,
                'status_pembayaran' => 'menunggu',
                'tanggal_pembayaran' => $faker->date,
                'bukti_pembayaran' => $faker->name
            ]
        ]);
    }
}
