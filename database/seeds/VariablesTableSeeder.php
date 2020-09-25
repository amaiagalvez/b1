<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Izt\Users\Classes\FieldTypes;

class VariablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('APP_variables')
            ->truncate();

        $variables = [
            [
                'name' => 'name',
                'title_eu' => 'Izena',
                'title_es' => 'Nombre',
                'value' => 'Aretha',
                'filed_type' => FieldTypes::TEXT,
                'editable' => '1',
                'development' => '0',
                'show' => '1',
                'active' => '1',
                'order' => '1',
                'notes_eu' => 'Aplikazioaren izena',
                'notes_es' => 'Nombre de la aplicación',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
            [
                'name' => 'logo',
                'value' => 'logo.png',
                'filed_name' => FieldTypes::IMAGE,
                'title_eu' => 'Logoa',
                'title_es' => 'Logo',
                'editable' => '1',
                'development' => '0',
                'show' => '1',
                'active' => '1',
                'order' => '2',
                'notes_eu' => 'Aplikazioaren logoa',
                'notes_es' => 'Logo de la aplicación',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
            [
                'name' => 'logo_small',
                'value' => 'logo_small.png',
                'filed_name' => FieldTypes::IMAGE,
                'title_eu' => 'Logo Txikia',
                'title_es' => 'Logo Pequeño',
                'editable' => '1',
                'development' => '0',
                'show' => '1',
                'active' => '1',
                'order' => '3',
                'notes_eu' => 'Aplikazioaren logo txikia',
                'notes_es' => 'Logo pequeño de la Aplicación',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
            [
                'name' => 'favicon',
                'value' => 'favicon.ico',
                'filed_name' => FieldTypes::IMAGE,
                'title_eu' => 'Favicon',
                'title_es' => 'Favicon',
                'editable' => '1',
                'development' => '0',
                'show' => '1',
                'active' => '1',
                'order' => '4',
                'notes_eu' => 'Aplikazioaren ikonoa',
                'notes_es' => 'Icono de la aplicación',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
            [
                'name' => 'lang',
                'value' => '["eu", "es"]',
                'filed_name' => FieldTypes::LIST,
                'title_eu' => 'Hizkuntzak',
                'title_es' => 'Idiomas',
                'editable' => '1',
                'development' => '0',
                'show' => '1',
                'active' => '1',
                'order' => '5',
                'notes_eu' => 'Aplikazioaren hizkuntzak',
                'notes_es' => 'Idiomas de la aplicación',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
            [
                'name' => 'email_problem_temporal_max',
                'value' => '3',
                'filed_name' => FieldTypes::NUMBER,
                'title_eu' => 'Email Arazo Tenporal Max',
                'title_es' => 'Problemas Temporales Email Max',
                'editable' => '1',
                'development' => '0',
                'show' => '1',
                'active' => '1',
                'order' => '6',
                'notes_eu' => ' x Email arazo tenporal jasotzen badira Email arazo permanente bihurtuko da',
                'notes_es' => 'Despues de dar x problemas temporales, se transformará en permanente ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
            [
                'name' => 'email_template',
                'value' => '<figure class="table">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td colspan="3">#emailerako_logoa#</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>#edukia#</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><small class="small">#lege_oharra#</small></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </figure>',
                'filed_name' => FieldTypes::LONGTEXT,
                'title_eu' => 'Email Bidalketarako Txantiloia',
                'title_es' => 'Plantilla Envío Emails',
                'editable' => '1',
                'development' => '0',
                'show' => '1',
                'active' => '1',
                'order' => '7',
                'notes_eu' => 'Bidalketetan erabiliko den txantiloia',
                'notes_es' => 'Plantilla que se utilizará en los envíos de emails',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
            [
                'name' => 'email_quantity_five_min',
                'value' => '10',
                'filed_name' => FieldTypes::NUMBER,
                'title_eu' => 'Email Bidalketa kopurua 5 minuturo',
                'title_es' => 'Número Emails enviados cada 5 minutos',
                'editable' => '0',
                'development' => '1',
                'show' => '1',
                'active' => '1',
                'order' => '9',
                'notes_eu' => 'Zenbat Email bidaliko diren 5 min-ko tartean (Ezin da editatu)',
                'notes_es' => 'Cuantos email se enviarñan en 5 min (No se puede editar)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
            [
                'name' => 'deliveries_kron_on',
                'value' => '0',
                'filed_name' => FieldTypes::BOOLEAN,
                'title_eu' => 'Email Kron Martxan',
                'title_es' => 'Email Kron en marcha',
                'editable' => '0',
                'development' => '1',
                'show' => '1',
                'active' => '1',
                'order' => '8',
                'notes_eu' => 'Jakiteko ea Email Bidalketetarako kron-a martxan dagoen edo ez (Ezin da editatu)',
                'notes_es' => 'Para saber si el Envío de emails está activo o no (No se puede editar)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
            [
                'name' => 'manual_on',
                'value' => '1',
                'filed_name' => FieldTypes::BOOLEAN,
                'title_eu' => 'Erakutsi Manuala',
                'title_es' => 'Enseñar el manual',
                'editable' => '0',
                'development' => '1',
                'show' => '0',
                'active' => '1',
                'order' => '10',
                'notes_eu' => '',
                'notes_es' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ]
        ];

        DB::table('APP_variables')
            ->insert($variables);
    }
}
