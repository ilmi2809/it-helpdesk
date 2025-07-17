<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Ticket_logsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('ticket_logs')->insert([
            ['ticket_id' => 1, 'user_id' => 1, 'status' => 'Baru', 'note' => 'Ex consectetur facilis nobis aliquid rem fugiat.', 'created_at' => '2025-07-15 07:41:05'],
            ['ticket_id' => 1, 'user_id' => 2, 'status' => 'On-Going', 'note' => 'Ratione necessitatibus odio velit accusamus sunt.', 'created_at' => '2025-07-15 08:11:05'],
            ['ticket_id' => 1, 'user_id' => 3, 'status' => 'Selesai', 'note' => 'Tenetur optio repellat facere doloribus consequatur est.', 'created_at' => '2025-07-15 08:41:05'],
            ['ticket_id' => 2, 'user_id' => 1, 'status' => 'Baru', 'note' => 'Dignissimos rerum repellendus totam.', 'created_at' => '2025-07-13 07:41:05'],
            ['ticket_id' => 2, 'user_id' => 2, 'status' => 'On-Going', 'note' => 'Molestias quidem eveniet sequi repudiandae dolore nesciunt.', 'created_at' => '2025-07-13 08:11:05'],
            ['ticket_id' => 2, 'user_id' => 3, 'status' => 'Selesai', 'note' => 'Maxime nisi ipsa nobis dolorem ut consequatur.', 'created_at' => '2025-07-13 08:41:05'],
            ['ticket_id' => 3, 'user_id' => 1, 'status' => 'Baru', 'note' => 'Illum labore ipsum optio.', 'created_at' => '2025-07-11 07:41:05'],
            ['ticket_id' => 3, 'user_id' => 2, 'status' => 'On-Going', 'note' => 'Cum quasi nisi nulla commodi alias quibusdam.', 'created_at' => '2025-07-11 08:11:05'],
            ['ticket_id' => 3, 'user_id' => 3, 'status' => 'Selesai', 'note' => 'Voluptates consectetur saepe illo.', 'created_at' => '2025-07-11 08:41:05'],
            ['ticket_id' => 4, 'user_id' => 1, 'status' => 'Baru', 'note' => 'Corrupti officiis itaque reprehenderit debitis fuga.', 'created_at' => '2025-07-12 07:41:05'],
            ['ticket_id' => 4, 'user_id' => 2, 'status' => 'On-Going', 'note' => 'Sint voluptates aliquid eaque enim in officiis labore.', 'created_at' => '2025-07-12 08:11:05'],
            ['ticket_id' => 4, 'user_id' => 3, 'status' => 'Selesai', 'note' => 'Sunt nobis libero repudiandae explicabo facere.', 'created_at' => '2025-07-12 08:41:05'],
            ['ticket_id' => 5, 'user_id' => 1, 'status' => 'Baru', 'note' => 'Hic magnam laudantium tempora dolore.', 'created_at' => '2025-07-15 07:41:05'],
            ['ticket_id' => 5, 'user_id' => 2, 'status' => 'On-Going', 'note' => 'Iure enim in nisi.', 'created_at' => '2025-07-15 08:11:05'],
            ['ticket_id' => 5, 'user_id' => 3, 'status' => 'Selesai', 'note' => 'Explicabo doloremque eveniet eius repellendus officiis voluptas.', 'created_at' => '2025-07-15 08:41:05']
        ]);

    }
}
