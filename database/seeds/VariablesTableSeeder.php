<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Izt\Basics\Classes\FieldTypes;
use Izt\Basics\Storage\Eloquent\Models\Variable;

class VariablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $variables = [
            [
                'application_id' => 1,
                'name' => 'name',
                'title_eu' => 'Izena',
                'title_es' => 'Nombre',
                'value' => 'Aretha',
                'filed_type' => FieldTypes::TEXT,
                'editable' => '1',
                'show' => '1',
                'order' => '1',
                'notes_eu' => 'Aplikazioaren izena',
                'notes_es' => 'Nombre de la aplicación',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'application_id' => 1,
                'name' => 'logo',
                'value' => 'logo.png',
                'filed_type' => FieldTypes::IMAGE,
                'title_eu' => 'Logoa',
                'title_es' => 'Logo',
                'editable' => '1',
                'show' => '1',
                'order' => '2',
                'notes_eu' => 'Aplikazioaren logoa',
                'notes_es' => 'Logo de la aplicación',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'application_id' => 1,
                'name' => 'logo_small',
                'value' => 'logo_small.png',
                'filed_type' => FieldTypes::IMAGE,
                'title_eu' => 'Logo Txikia',
                'title_es' => 'Logo Pequeño',
                'editable' => '1',
                'show' => '1',
                'order' => '3',
                'notes_eu' => 'Aplikazioaren logo txikia',
                'notes_es' => 'Logo pequeño de la Aplicación',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'application_id' => 1,
                'name' => 'favicon',
                'value' => 'favicon.ico',
                'filed_type' => FieldTypes::IMAGE,
                'title_eu' => 'Favicon',
                'title_es' => 'Favicon',
                'editable' => '1',
                'show' => '1',
                'order' => '4',
                'notes_eu' => 'Aplikazioaren ikonoa',
                'notes_es' => 'Icono de la aplicación',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'application_id' => 1,
                'name' => 'lang',
                'value' => '["eu", "es"]',
                'filed_type' => FieldTypes::LIST,
                'title_eu' => 'Hizkuntzak',
                'title_es' => 'Idiomas',
                'editable' => '1',
                'show' => '1',
                'order' => '5',
                'notes_eu' => 'Aplikazioaren hizkuntzak',
                'notes_es' => 'Idiomas de la aplicación',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'updated_by' => 1
            ]
        ];

        foreach ($variables as $variable) {
            if (!Variable::where('name', $variable['name'])->first()) {
                DB::table('APP_variables')->insert($variable);
            }
        }
    }
}
