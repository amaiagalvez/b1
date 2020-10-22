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
                'name' => '1.0.0',
                'notes_eu' => 'Erabiltzaileen kudeaketa basikoa. <br> Erabiltzaileeen saioak gordetzen dira. <br> Rolen kudeaketa basikoa (Admin bai/ez). <br> Aplikazioa modu basiko batean konfiguratzeko aldagaien kudeaketa (izena, logoa, ...)',
                'notes_es' => 'Gestión básica de usuarias. <br> Se guardan las sesiones de las usuarias <br> Gestión básica de roles (Admin si/no). <br> Gestión de variables para la configuración básica de la aplicación (nombre, logo, ...)',
                'created_at' => '2020-10-01',
                'updated_at' => '2020-10-01',
                'created_by' => 1
            ]
        ];

        DB::table('APP_versions')
            ->insert($versions);
    }
}
