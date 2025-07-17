<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Ticket_attachmentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('ticket_attachments')->insert([
            ['id' => 1, 'ticket_id' => 1, 'file_path' => 'Screenshot_Error.png', 'created_at' => '2025-07-16 07:41:05'],
            ['id' => 2, 'ticket_id' => 2, 'file_path' => 'Screenshot_Error.png', 'created_at' => '2025-07-16 07:41:05'],
            ['id' => 3, 'ticket_id' => 1, 'file_path' => 'Screenshot_Error.png', 'created_at' => '2025-07-16 07:41:05'],
            ['id' => 4, 'ticket_id' => 1, 'file_path' => 'Screenshot_Error.png', 'created_at' => '2025-07-16 07:41:05'],
            ['id' => 5, 'ticket_id' => 1, 'file_path' => 'Screenshot_Error.png', 'created_at' => '2025-07-16 07:41:05']
        ]);

    }
}
