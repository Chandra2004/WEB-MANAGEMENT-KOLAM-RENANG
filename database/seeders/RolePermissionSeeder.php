<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. DEFINISI PERMISSIONS
        $permissions = [
            // User Management
            'users.view', 'users.create', 'users.edit', 'users.delete',
            
            // Club Management
            'clubs.view', 'clubs.create', 'clubs.edit', 'clubs.delete',
            
            // Event Management
            'events.view', 'events.create', 'events.edit', 'events.delete', 'events.publish',
            
            // Registration Management
            'registrations.view', 'registrations.create', 'registrations.edit', 'registrations.delete', 'registrations.approve',
            
            // Results & Timing
            'results.view', 'results.create', 'results.edit', 'results.delete',
            
            // Payment Management
            'payments.view', 'payments.create', 'payments.edit', 'payments.confirm',
            
            // Settings & System
            'settings.view', 'settings.edit',
            'activity_logs.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ], [
                'uid' => (string) \Illuminate\Support\Str::uuid()
            ]);
        }

        // 2. DEFINISI ROLES & ASSIGN PERMISSIONS

        // SUPERADMIN: Semua hak akses
        $superadmin = Role::firstOrCreate(['name' => 'superadmin'], ['uid' => (string) \Illuminate\Support\Str::uuid()]);
        $superadmin->givePermissionTo(Permission::all());

        // ADMIN: Mengelola operasional harian
        $admin = Role::firstOrCreate(['name' => 'admin'], ['uid' => (string) \Illuminate\Support\Str::uuid()]);
        $admin->givePermissionTo([
            'users.view', 'users.create', 'users.edit',
            'clubs.view', 'clubs.create', 'clubs.edit',
            'events.view', 'events.create', 'events.edit', 'events.publish',
            'registrations.view', 'registrations.approve',
            'results.view', 'results.create', 'results.edit',
            'payments.view', 'payments.confirm',
            'settings.view',
        ]);

        // PELATIH: Mengelola klub dan melihat event
        $coach = Role::firstOrCreate(['name' => 'pelatih'], ['uid' => (string) \Illuminate\Support\Str::uuid()]);
        $coach->givePermissionTo([
            'clubs.view', 'clubs.edit',
            'events.view',
            'registrations.view', 'registrations.create',
            'results.view',
        ]);

        // ATLET: Hanya bisa melihat event dan hasil
        $athlete = Role::firstOrCreate(['name' => 'atlet'], ['uid' => (string) \Illuminate\Support\Str::uuid()]);
        $athlete->givePermissionTo([
            'events.view',
            'registrations.view',
            'results.view',
        ]);
    }
}
