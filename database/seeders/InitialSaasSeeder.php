<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialSaasSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'superadmin@assetpulse.test',
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('SuperAdmin@123'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        $org = Organization::firstOrCreate([
            'code' => 'DEMO',
        ], [
            'name' => 'Demo Organization',
            'email' => 'admin@demo.test',
            'phone' => '9999999999',
            'address' => 'Demo Address',
        ]);

        User::firstOrCreate([
            'email' => 'admin@demo.test',
        ], [
            'organization_id' => $org->id,
            'name' => 'Main Admin',
            'password' => Hash::make('Admin@12345'),
            'role' => 'admin',
            'is_active' => true,
        ]);
    }
}
