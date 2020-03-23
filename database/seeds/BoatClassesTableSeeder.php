<?php

use Illuminate\Database\Seeder;

class BoatClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('boat_classes')->insert([
            'name' => 'Luxury Class',
            'description' => 'Has all luxuries',
        ]);

        DB::table('boat_classes')->insert([
            'name' => 'First Class',
            'description' => 'All first class facilities',
        ]);

        DB::table('boat_classes')->insert([
            'name' => 'Mid Range',
            'description' => 'For every one, all basic features',
        ]);

        DB::table('boat_classes')->insert([
            'name' => 'Budget Class',
            'description' => 'Economic, with all features',
        ]);

        DB::table('boat_classes')->insert([
            'name' => 'Diving Cruise',
            'description' => 'With diving features',
        ]);
    }
}
