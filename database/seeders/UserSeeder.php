<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'type' => 'Admin',
            'code' => null,
            'code_type'=> null,
            'name' => 'Super usuario',
            'email' => 'superuser@limacap.com',
            'email_verified_at' => now(),
            'password' => bcrypt('superuser'),
            'address' => null,
            'phone' => null,
            'area_id' => null,
            'is_admin' => 1,
            'state' => "Activo",
          ])->assignRole('admin');
    }
}
