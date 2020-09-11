<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Izt\Users\Storage\Eloquent\Models\Module;
use Izt\Users\Storage\Eloquent\Models\ModuleRole;
use Izt\Users\Storage\Eloquent\Models\Role;
use Izt\Users\Storage\Eloquent\Models\Session;
use Izt\Users\Storage\Eloquent\Models\User;
use Izt\Users\Storage\Eloquent\Models\Version;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 15)->create();
        factory(Role::class, 5)->create();
        factory(Session::class, 30)->create();
        factory(Module::class, 15)->create();
        factory(ModuleRole::class, 30)->create();
        factory(Version::class, 15)->create();

    }
}
