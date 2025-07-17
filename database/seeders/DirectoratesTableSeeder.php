<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectoratesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('directorates')->insert([
            ['id' => 1, 'name' => 'Direktorat 1', 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['id' => 2, 'name' => 'Direktorat 2', 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['id' => 3, 'name' => 'Direktorat 3', 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05']
        ]);
    }
}
