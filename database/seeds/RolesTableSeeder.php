<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Izt\Basics\Storage\Eloquent\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'application_id' => 1,
                'name' => 'admin',
                'title_eu' => 'Arduraduna',
                'title_es' => 'Responsable',
                'notes_eu' => 'Arduradunak dena kudeatzeko baimena dauka',
                'notes_es' => 'La responsable tiene permiso para gestionar todo',
                'created_at' => date('Y-m-d H:i:d'),
                'updated_at' => date('Y-m-d H:i:d'),
                'created_by' => 1
            ],
            [
                'application_id' => 1,
                'name' => 'web',
                'title_eu' => 'Web Erabiltzailea',
                'title_es' => 'Usuaria Web',
                'notes_eu' => 'Webgunetik eman du izena',
                'notes_es' => 'Se ha registrado desde la web',
                'active' => 0,
                'created_at' => date('Y-m-d H:i:d'),
                'updated_at' => date('Y-m-d H:i:d'),
                'created_by' => 1
            ]
        ];

        foreach ($roles as $role) {
            if (!Role::where('name', $role['name'])->first()) {
                DB::table('APP_roles')->insert($role);
            }
        }
    }
}
