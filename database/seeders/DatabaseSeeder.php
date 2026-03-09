<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Spatie Permission roles
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $editor     = Role::firstOrCreate(['name' => 'editor',      'guard_name' => 'web']);

        // Create the first Super Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@m-one-solution.com'],
            [
                'name'     => 'Admin M-One Solution',
                'password' => bcrypt('password'), // CHANGE THIS AFTER FIRST LOGIN!
            ]
        );
        $admin->assignRole($superAdmin);

        // Seed default global settings
        $defaults = [
            'company_name'    => 'M-One Solution',
            'company_address' => 'Jl. Contoh No.1, Kota Anda',
            'contact_email'   => 'info@m-one-solution.com',
            'contact_phone'   => '+62 xxx xxxx xxxx',
            'whatsapp_number' => '628xxxxxxxxxx',
            'facebook_url'    => '',
            'instagram_url'   => '',
            'tiktok_url'      => '',
            'youtube_url'     => '',
            'linkedin_url'    => '',
        ];

        foreach ($defaults as $key => $value) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
