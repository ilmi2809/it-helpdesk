<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('departments')->insert([
            ['id' => 1, 'name' => 'Departemen 1', 'directorate_id' => 3, 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['id' => 2, 'name' => 'Departemen 2', 'directorate_id' => 2, 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['id' => 3, 'name' => 'Departemen 3', 'directorate_id' => 3, 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['id' => 4, 'name' => 'Departemen 4', 'directorate_id' => 3, 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['id' => 5, 'name' => 'Departemen 5', 'directorate_id' => 1, 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05']
        ]);
    }
}
