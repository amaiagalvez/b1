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
                'notes_eu' => 'Erabiltzaileen kudeaketa basikoa. <br> Erabiltzaileeen saioak gordetzen dira',
                'notes_es' => 'Gestión básica de usuarias. <br> Se guardan las sesiones de las usuarias',
                'created_at' => '2020-10-01',
                'updated_at' => '2020-10-01',
                'created_by' => 1
            ],
            [
                'application_id' => 1,
                'name' => '1.0',
                'notes_eu' => 'Rolen kudeaketa basikoa (Admin bai/ez). <br> Aplikazioa modu basiko batean konfiguratzeko aldagaien kudeaketa (izena, logoa, ...)',
                'notes_es' => 'Gestión básica de roles (Admin si/no). <br> Gestión de variables para la configuración básica de la aplicación (nombre, logo, ...)',
                'created_at' => '2020-10-02',
                'updated_at' => '2020-10-02',
                'created_by' => 1
            ]
        ];

        DB::table('APP_versions')
            ->insert($versions);
    }
}
