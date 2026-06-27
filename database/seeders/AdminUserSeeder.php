<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'Administrator')->first();

        $admin = User::firstOrCreate([
            'email' => 'admin@mpcms.com',
        ], [
            'name' => 'System Admin',
            'password' => Hash::make('password123'),
        ]);

        $admin->assignRole($adminRole);
    }
}