<?php

namespace Database\Seeders;

use Faker\Factory;
use TheFramework\Database\Seeder;
use TheFramework\Helpers\Helper;
use TheFramework\Models\Event;

class Seeder_2026_02_15_172429_GalleriesSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $this->setTable('galleries');

        // Ambil semua event yang ada di database
        $events = Event::all();

        if (empty($events)) {
            echo "Tidak ada event yang ditemukan. Mohon jalankan seeder Event terlebih dahulu.\n";
            return;
        }

        // Daftar gambar yang tersedia untuk dipilih secara acak
        $imageNames = [
            'gambar_renang_1.webp', 'gambar_renang_2.webp', 'gambar_renang_3.webp', 'gambar_renang_4.webp',
            'gambar_renang_7.webp', 'gambar_renang_9.webp', 'gambar_renang_10.webp', 'gambar_renang_11.webp',
            'gambar_renang_12.webp', 'gambar_renang_13.webp', 'gambar_renang_14.webp', 'gambar_renang_15.webp',
            'gambar_renang_16.webp', 'gambar_renang_17.webp', 'gambar_renang_18.webp', 'gambar_renang_19.webp',
            'gambar_renang_20.webp', 'gambar_renang_21.webp', 'gambar_renang_22.webp', 'gambar_renang_23.webp'
        ];

        $galleries = [];

        // Looping untuk setiap event
        foreach ($events as $event) {
            // Looping 100 kali untuk membuat galeri per event
            for ($i = 0; $i < 100; $i++) {
                $galleries[] = [
                    'uid' => Helper::uuid(),
                    'uid_event' => $event['uid'],
                    'foto_event' => $faker->randomElement($imageNames),
                ];
            }
        }

        // Masukkan semua data galeri sekaligus (bulk insert)
        $this->create($galleries);
    }
}
