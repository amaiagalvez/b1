<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('APP_applications')
            ->truncate();

        $applications = [
            [
                'id' => 1,
                'title_eu' => 'Erabiltzaileak, Rolak eta Menuak',
                'title_es' => 'Usuarios, Roles y Menús',
                'notes_eu' => 'Erabiltzaileen, Rolen eta Menuen kudeaketa',
                'notes_es' => 'Gestión de usuarios, roles y menús',
                'created_at' => date('Y-m-d H:i:d'),
                'updated_at' => date('Y-m-d H:i:d'),
                'created_by' => 1
            ]
        ];

        DB::table('APP_applications')
            ->insert($applications);

    }
}
