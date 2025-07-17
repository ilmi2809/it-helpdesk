<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            UsersTableSeeder::class,
            DirectoratesTableSeeder::class,
            DepartmentsTableSeeder::class,
            CategoriesTableSeeder::class,
            Sla_policiesTableSeeder::class,
            TicketsTableSeeder::class,
            Ticket_logsTableSeeder::class,
            Ticket_attachmentsTableSeeder::class,
        ]);
    }
}
