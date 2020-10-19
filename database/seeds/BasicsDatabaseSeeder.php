<?php

use Illuminate\Database\Seeder;

class BasicsDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ApplicationsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(VariablesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(VersionTableSeeder::class);
    }
}
