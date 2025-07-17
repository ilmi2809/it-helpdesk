<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Sla_policiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('sla_policies')->insert([
            ['id' => 1, 'name' => 'SLA High 1', 'category_id' => 2, 'priority' => 'high', 'response_time_minutes' => 2, 'resolution_time_minutes' => 3, 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['id' => 2, 'name' => 'SLA Medium 1', 'category_id' => 3, 'priority' => 'medium', 'response_time_minutes' => 1, 'resolution_time_minutes' => 7, 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['id' => 3, 'name' => 'SLA High 2', 'category_id' => 3, 'priority' => 'high', 'response_time_minutes' => 1, 'resolution_time_minutes' => 3, 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['id' => 4, 'name' => 'SLA High 3', 'category_id' => 2, 'priority' => 'high', 'response_time_minutes' => 1, 'resolution_time_minutes' => 4, 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05'],
            ['id' => 5, 'name' => 'SLA High 4', 'category_id' => 3, 'priority' => 'high', 'response_time_minutes' => 3, 'resolution_time_minutes' => 5, 'created_at' => '2025-07-16 07:41:05', 'updated_at' => '2025-07-16 07:41:05']
        ]);
    }
}
