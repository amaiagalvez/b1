<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
            ->truncate();

        $users = [
            [
                'id' => 1,
                'name' => 'Admin IZT',
                'email' => 'info@izt.eus',
                'password' => Hash::make('123456'),
                'active' => '1',
                'role_name' => 'admin',
                'lang' => 'eu',
                'email_verified_at' => now(),
                'created_at' => date('Y-m-d H:i:d'),
                'updated_at' => date('Y-m-d H:i:d'),
                'created_by' => null
            ],
            [
                'id' => 2,
                'name' => 'Admin ARETHA',
                'email' => 'info@aretha.eus',
                'password' => Hash::make('123456'),
                'active' => '1',
                'role_name' => 'admin',
                'lang' => 'eu',
                'email_verified_at' => now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => null
            ]
        ];

        DB::table('users')
            ->insert($users);
    }
}
