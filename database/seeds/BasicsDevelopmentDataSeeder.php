<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Izt\Basics\Storage\Eloquent\Models\Area;
use Izt\Basics\Storage\Eloquent\Models\Country;
use Izt\Basics\Storage\Eloquent\Models\District;
use Izt\Basics\Storage\Eloquent\Models\Neighborhood;
use Izt\Basics\Storage\Eloquent\Models\PostalCode;
use Izt\Basics\Storage\Eloquent\Models\State;
use Izt\Basics\Storage\Eloquent\Models\Town;

class BasicsDevelopmentDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        DB::table('LOC_states')->truncate();
        DB::table('LOC_countries')->truncate();
        DB::table('LOC_districts')->truncate();
        DB::table('LOC_towns')->truncate();
        DB::table('LOC_neighborhoods')->truncate();
        DB::table('LOC_areas')->truncate();
        DB::table('LOC_area_LOC_town')->truncate();
        DB::table('LOC_postal_codes')->truncate();

        fCreate(State::class, [], 5);
        fCreate(Country::class, [], 5);
        fCreate(District::class, [], 5);
        fCreate(Town::class, [], 5);
        fCreate(Neighborhood::class, [], 5);
        fCreate(Area::class, [], 5);
        fCreate(PostalCode::class, [], 5);
    }
}
