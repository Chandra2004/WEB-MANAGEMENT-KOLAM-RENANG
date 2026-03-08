<?php

namespace Database\Seeders;

use Faker\Factory;
use TheFramework\Database\Seeder;
use TheFramework\Helpers\Helper;
use TheFramework\Models\Category;
use TheFramework\Models\User;

class Seeder_2026_02_15_172416_EventsSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');
        $this->setTable('events');

        // Ambil semua data yang diperlukan sekali saja
        $categories = Category::all();
        $users = User::all();

        // Jika tidak ada kategori atau user, hentikan seeder
        if (empty($categories) || empty($users)) {
            echo "Tidak ada Kategori atau User yang ditemukan. Mohon jalankan seeder Kategori dan User terlebih dahulu.\n";
            return;
        }

        // Daftar banner yang tersedia
        $imageNames = [
            'gambar_renang_1.webp', 'gambar_renang_2.webp', 'gambar_renang_3.webp', 'gambar_renang_4.webp',
            'gambar_renang_7.webp', 'gambar_renang_9.webp', 'gambar_renang_10.webp', 'gambar_renang_11.webp',
            'gambar_renang_12.webp', 'gambar_renang_13.webp', 'gambar_renang_14.webp', 'gambar_renang_15.webp',
            'gambar_renang_16.webp', 'gambar_renang_17.webp', 'gambar_renang_18.webp', 'gambar_renang_19.webp',
            'gambar_renang_20.webp', 'gambar_renang_21.webp', 'gambar_renang_22.webp', 'gambar_renang_23.webp'
        ];
        
        $events = [];

        for ($i = 0; $i < 100; $i++) {
            $events[] = [
                'uid' => Helper::uuid(),
                'nama_event' => 'Kejuaraan Renang ' . $faker->city,
                'slug' => Helper::slugify('Kejuaraan Renang ' . $faker->city . Helper::uuid()),
                'deskripsi' => $faker->realText(200),
                'lokasi_event' => $faker->address,
                'tanggal_event' => $faker->dateTimeBetween('+1 month', '+1 year')->format('Y-m-d'),
                'tipe_event' => $faker->randomElement(['gratis', 'berbayar']),
                'biaya_event' => $faker->numberBetween(50000, 500000),
                'status_event' => $faker->randomElement(['ditunda', 'berjalan', 'ditutup']),
                'banner_event' => $faker->randomElement($imageNames),
                'uid_kategori' => $faker->randomElement($categories)['uid'],
                'uid_author' => $faker->randomElement($users)['uid'],
            ];
        }

        $this->create($events);
    }
}
