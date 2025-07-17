<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('categories')->insert([
            ['name' => 'TVM', 'description' => 'TVM', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Network', 'description' => 'Network', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'AC', 'description' => 'AC', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
