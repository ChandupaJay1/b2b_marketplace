<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles — only admin and user (vendors have no login)
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);

        // Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@b2bmarket.com'],
            [
                'name'      => 'Admin',
                'password'  => Hash::make('Admin@1234'),
                'is_active' => true,
            ]
        );
        $admin->assignRole('admin');

        // Demo user
        $user = User::firstOrCreate(
            ['email' => 'user@b2bmarket.com'],
            [
                'name'      => 'Demo User',
                'password'  => Hash::make('User@1234'),
                'is_active' => true,
            ]
        );
        $user->assignRole('user');

        // Run our automated seeders which contain ONLY the corrected Excel data
        $this->call([
            ProductCategorySeeder::class,
            VendorExcelSeeder::class,
            DemoProductSeeder::class,
        ]);
    }
}
