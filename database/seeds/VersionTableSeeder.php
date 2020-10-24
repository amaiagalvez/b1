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
                'notes_eu' => '
                Erabiltzaileen kudeaketa basikoa (Altak, bajak, pasahitza berreskuratu). <br> 
                Erabiltzaileeen saioak gordetzen dira. <br> 
                Rolen kudeaketa basikoa (Admin Bai/Ez). <br> 
                Aplikazioa konfiguratzeko aldagaien kudeaketa (izena, logoa, ...).',
                'notes_es' => '
                Gestión básica de usuarias (Altas, bajas, recuperar contraseña).<br> 
                Se guardan las sesiones de las usuarias. <br> 
                Gestión básica de roles (Admin Si/No). <br> 
                Gestión de variables para la configuración de la aplicación (nombre, logo, ...).',
                'created_at' => '2020-10-01',
                'updated_at' => '2020-10-01',
                'created_by' => 1
            ]
        ];

        DB::table('APP_versions')
            ->insert($versions);
    }
}
