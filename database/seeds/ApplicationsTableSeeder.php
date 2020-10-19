<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationsTableSeeder extends Seeder
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
                'title_eu' => 'Kudeaketa',
                'title_es' => 'Gestión',
                'notes_eu' => 'Erabiltzaileen, Rolen eta Menuen kudeaketa',
                'notes_es' => 'Gestión de usuarios, roles y menús',
                'order' => 999,
                'created_at' => date('Y-m-d H:i:d'),
                'updated_at' => date('Y-m-d H:i:d'),
                'created_by' => 1
            ]
        ];

        DB::table('APP_applications')
            ->insert($applications);

    }
}
