<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VersionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('APP_versions')
            ->truncate();

        $versions = [
            [
                'application_id' => 1,
                'name' => '1.0',
                'notes_eu' => 'Erabiltzaileen, Rolen eta Menuen kudeaketa basikoa',
                'notes_es' => 'Gestión básica de usuarios, roles y menús',
                'created_at' => '2020-10-01',
                'updated_at' => '2020-10-01',
                'created_by' => 1
            ]
        ];

        DB::table('APP_versions')
            ->insert($versions);
    }
}
