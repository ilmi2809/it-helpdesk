<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tickets')->insert([
            ['id' => 1, 'ticket_number' => '20240701-001', 'title' => 'Aperiam nobis minus in amet magni corrupti hic.', 'description' => 'Voluptas distinctio perspiciatis.
Ducimus nihil blanditiis maiores est in. Vitae ipsum neque.', 'status' => 'resolved', 'priority' => 'high', 'user_id' => 1, 'department_id' => 2, 'category_id' => 2, 'created_at' => '2025-07-15 07:41:05', 'updated_at' => '2025-07-15 09:41:05'],
            ['id' => 2, 'ticket_number' => '20240702-002', 'title' => 'Odit natus mollitia ut ullam.', 'description' => 'Nesciunt ipsa magnam incidunt. Quisquam culpa placeat. Et nemo expedita assumenda porro.', 'status' => 'new', 'priority' => 'high', 'user_id' => 4, 'department_id' => 4, 'category_id' => 1, 'created_at' => '2025-07-13 07:41:05', 'updated_at' => '2025-07-13 09:41:05'],
            ['id' => 3, 'ticket_number' => '20240703-003', 'title' => 'Iure natus quis nulla ex ipsum soluta.', 'description' => 'Ex dolorum iusto adipisci nostrum natus. Architecto numquam explicabo ipsa.', 'status' => 'on_going', 'priority' => 'medium', 'user_id' => 3, 'department_id' => 2, 'category_id' => 2, 'created_at' => '2025-07-11 07:41:05', 'updated_at' => '2025-07-11 09:41:05'],
            ['id' => 4, 'ticket_number' => '20240704-004', 'title' => 'Enim consequuntur dolorum odit quibusdam qui.', 'description' => 'Iste corrupti praesentium ea. Cupiditate sequi eius sequi modi officiis.', 'status' => 'resolved', 'priority' => 'low', 'user_id' => 3, 'department_id' => 2, 'category_id' => 2, 'created_at' => '2025-07-12 07:41:05', 'updated_at' => '2025-07-12 09:41:05'],
            ['id' => 5, 'ticket_number' => '20240705-005', 'title' => 'Id iusto commodi maiores perferendis.', 'description' => 'Alias dolore assumenda dicta harum. Officiis voluptatum qui labore veritatis.', 'status' => 'resolved', 'priority' => 'low', 'user_id' => 1, 'department_id' => 2, 'category_id' => 1, 'created_at' => '2025-07-15 07:41:05', 'updated_at' => '2025-07-15 09:41:05']
        ]);
    }
}
