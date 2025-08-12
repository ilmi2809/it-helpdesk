<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $tree = [
            'BUILDING' => [
                ['name' => 'A300'],
                ['name' => 'CCTV'],
                ['name' => 'DB-100'],
                ['name' => 'NVR'],
                ['name' => 'X401']
            ],
            'COMMUNICATION' => [
                ['name' => 'IP PHONE']
            ],
            'COMPUTER' => [
                ['name' => 'DESKTOP'],
                ['name' => 'LAPTOP'],
                ['name' => 'NONE'],
                ['name' => 'PC'],
                ['name' => 'TABLET']
            ],
            'DISPLAY' => [
                ['name' => 'CAMERA'],
                ['name' => 'LED'],
                ['name' => 'MICROPHONE'],
                ['name' => 'PROJECTOR']
            ],
            'FAXIMILE' => [
                ['name' => 'FAXIMILE']
            ],
            'NETWORK' => [
                ['name' => 'CORE SWITCH'],
                ['name' => 'DISTRIBUTION SWITCH'],
                ['name' => 'FIREWALL'],
                ['name' => 'MODEM WIFI'],
                ['name' => 'POE SWITCH'],
                ['name' => 'WIFI'],
                ['name' => 'WIFI CONTROLLER']
            ],
            'PRINTER' => [
                ['name' => 'PRINTER'],
                ['name' => 'PRINTER + FAX'],
                ['name' => 'PRINTER BLACK WHITE']
            ],
            'SCANNER' => [
                ['name' => 'SCANNER']
            ],
            'SERVER' => [
                ['name' => 'MAIN SERVER'],
                ['name' => 'SERVER EQUIPMENT']
            ],
            'SHREDDER' => [
                ['name' => 'SHREDDER']
            ]
        ];

        DB::transaction(function () use ($tree) {
            $orderParent = 1;
            foreach ($tree as $parentName => $children) {
                $parentSlug = Str::slug($parentName);
                $parent = Category::firstOrCreate(
                    ['slug' => $parentSlug],
                    [
                        'name'        => $parentName,
                        'description' => $parentName . ' related issues',
                        'order'       => $orderParent,
                    ]
                );

                $orderChild = 1;
                foreach ($children as $child) {
                    $childName = $child['name'];
                    $childSlug = Str::slug($parentName . '-' . $childName);
                    Category::firstOrCreate(
                        ['slug' => $childSlug],
                        [
                            'name'        => $childName,
                            'parent_id'   => $parent->id,
                            'description' => $childName . ' related issues',
                            'order'       => $orderChild,
                        ]
                    );
                    $orderChild++;
                }

                $orderParent++;
            }
        });
    }
}
