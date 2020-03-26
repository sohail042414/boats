<?php

use Illuminate\Database\Seeder;

class CruiseCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cruise_categories')->insert([
            'name' => 'Luxury Class',
            'description' => 'Has all luxuries',
        ]);

        DB::table('cruise_categories')->insert([
            'name' => 'First Class',
            'description' => 'All first class facilities',
        ]);

        DB::table('cruise_categories')->insert([
            'name' => 'Mid Range',
            'description' => 'For every one, all basic features',
        ]);

        DB::table('cruise_categories')->insert([
            'name' => 'Budget Class',
            'description' => 'Economic, with all features',
        ]);

        DB::table('cruise_categories')->insert([
            'name' => 'Diving Cruise',
            'description' => 'With diving features',
        ]);
    }
}
