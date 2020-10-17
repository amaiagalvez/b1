<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('APP_menus')
            ->truncate();

        $menus = [
            [
                'id' => 10,
                'application_id' => 1,
                'name' => 'basics::basics.user',
                'route' => '#',
                'icon' => 'fas fa-users',
                'parent_id' => null,
                'active' => '1',
                'order' => '50',
                'created_at' => date('Y-m-d H:i:d'),
                'updated_at' => date('Y-m-d H:i:d'),
                'created_by' => 1
            ],
            [
                'id' => 11,
                'application_id' => 1,
                'name' => 'basics::basics.user',
                'route' => 'users.index',
                'icon' => 'fas fa-users',
                'parent_id' => '10',
                'active' => '1',
                'order' => '1',
                'created_at' => date('Y-m-d H:i:d'),
                'updated_at' => date('Y-m-d H:i:d'),
                'created_by' => 1
            ],
            [
                'id' => 12,
                'application_id' => 1,
                'name' => 'basics::basics.session',
                'route' => 'sessions.index',
                'icon' => 'fas fa-sign-out-alt',
                'parent_id' => '10',
                'active' => '1',
                'order' => '2',
                'created_at' => date('Y-m-d H:i:d'),
                'updated_at' => date('Y-m-d H:i:d'),
                'created_by' => 1
            ],
            [
                'id' => 13,
                'application_id' => 1,
                'name' => 'basics::basics.role',
                'route' => 'roles.index',
                'icon' => 'fas fa-users-cog',
                'parent_id' => '10',
                'active' => '1',
                'order' => '3',
                'created_at' => date('Y-m-d H:i:d'),
                'updated_at' => date('Y-m-d H:i:d'),
                'created_by' => 1
            ],
            [
                'id' => 20,
                'application_id' => 1,
                'name' => 'basics::basics.configuration',
                'route' => '#',
                'icon' => 'fas fa-cog',
                'parent_id' => null,
                'active' => '1',
                'order' => '60',
                'created_at' => date('Y-m-d H:i:d'),
                'updated_at' => date('Y-m-d H:i:d'),
                'created_by' => 1
            ],
            [
                'id' => 21,
                'application_id' => null,
                'name' => 'basics::basics.application',
                'route' => 'variables.index',
                'icon' => 'fas fa-question',
                'parent_id' => '20',
                'active' => '1',
                'order' => '1',
                'created_at' => date('Y-m-d H:i:d'),
                'updated_at' => date('Y-m-d H:i:d'),
                'created_by' => 1
            ],
            [
                'id' => 22,
                'application_id' => null,
                'name' => 'basics::basics.version',
                'route' => 'versions.index',
                'icon' => 'fas fa-code-branch',
                'parent_id' => 20,
                'active' => '1',
                'order' => '2',
                'created_at' => date('Y-m-d H:i:d'),
                'updated_at' => date('Y-m-d H:i:d'),
                'created_by' => 1
            ],
            [
                'id' => 23,
                'application_id' => null,
                'name' => 'basics::basics.menu',
                'route' => 'menus.index',
                'icon' => 'fab fa-elementor',
                'parent_id' => 20,
                'active' => '1',
                'order' => '3',
                'created_at' => date('Y-m-d H:i:d'),
                'updated_at' => date('Y-m-d H:i:d'),
                'created_by' => 1
            ]
        ];

        DB::table('APP_menus')
            ->insert($menus);
    }
}
