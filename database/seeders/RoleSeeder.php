<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'Administrator']);
        Role::firstOrCreate(['name' => 'Veterinarian']);
        Role::firstOrCreate(['name' => 'Receptionist']);
        Role::firstOrCreate(['name' => 'Pet Owner']);

        $this->call(RoleSeeder::class);
    }
}