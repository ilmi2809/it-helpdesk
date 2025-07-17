<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'Lili Sinaga', 'email' => 'mulyasiregar@gmail.com', 'role' => 'user', 'email_verified_at' => '2025-07-16 07:41:05', 'password' => 'password', 'remember_token' => 'a0d20bac-f875-4289-ae3b-32171feb9b00', 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['name' => 'Pangeran Wahyudin, M.Farm', 'email' => 'jsuartini@ud.com', 'role' => 'user', 'email_verified_at' => '2025-07-16 07:41:05', 'password' => 'password', 'remember_token' => '64be67b2-ae3b-45ef-a944-1ee3df721ec3', 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['name' => 'Tantri Prasetya', 'email' => 'mprasetya@hotmail.com', 'role' => 'user', 'email_verified_at' => '2025-07-16 07:41:05', 'password' => 'password', 'remember_token' => 'c05dd5fa-8acd-4b2d-b021-60f00613910c', 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['name' => 'Balapati Wulandari', 'email' => 'luthfimardhiyah@pt.int', 'role' => 'user', 'email_verified_at' => '2025-07-16 07:41:05', 'password' => 'password', 'remember_token' => '1f82730a-46fc-47e5-8fa4-2e480cca6058', 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['name' => 'R. Enteng Suryono, M.Kom.', 'email' => 'isamosir@hotmail.com', 'role' => 'user', 'email_verified_at' => '2025-07-16 07:41:05', 'password' => 'password', 'remember_token' => 'c701ef98-1b4a-4d89-9b16-45218acdedd1', 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05']
        ]);
    }
}
