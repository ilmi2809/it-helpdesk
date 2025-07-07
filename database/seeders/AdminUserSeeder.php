<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@kcic.local'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );
    }
}
