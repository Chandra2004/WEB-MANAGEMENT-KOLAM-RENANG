<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\DataUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Superadmin
        $superadmin = User::updateOrCreate(
            ['email' => 'superadmin@khafid.com'],
            [
                'username' => 'superadmin',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
        $superadmin->assignRole('superadmin');
        $this->createProfile($superadmin, 'Super Admin');

        // 2. Create Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@khafid.com'],
            [
                'username' => 'admin',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
        $admin->assignRole('admin');
        $this->createProfile($admin, 'Admin Official');

        // 3. Create Pelatih
        $coach = User::updateOrCreate(
            ['email' => 'pelatih@khafid.com'],
            [
                'username' => 'pelatih',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
        $coach->assignRole('pelatih');
        $this->createProfile($coach, 'Coach Khafid');

        // 4. Create Atlet
        $athlete = User::updateOrCreate(
            ['email' => 'atlet@khafid.com'],
            [
                'username' => 'atlet',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
        $athlete->assignRole('atlet');
        $this->createProfile($athlete, 'Swimmer One');
    }

    /**
     * Helper to create a basic profile
     */
    private function createProfile($user, $name)
    {
        DataUser::updateOrCreate(
            ['user_uid' => $user->uid],
            [
                'full_name' => $name,
                'is_active' => true,
            ]
        );
    }
}
