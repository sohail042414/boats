<?php

use Illuminate\Database\Seeder;

class BoatTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                //
        DB::table('boat_types')->insert([
            'name' => 'Small Yacht',
            'description' => 'Has all luxuries',
        ]);

        DB::table('boat_types')->insert([
            'name' => 'Big Ship ',
            'description' => 'All first class facilities',
        ]);

        DB::table('boat_types')->insert([
            'name' => 'Mid ship ',
            'description' => 'All first class facilities',
        ]);

        DB::table('boat_types')->insert([
            'name' => 'Very Large cruise ',
            'description' => 'All first class facilities',
        ]);

        DB::table('boat_types')->insert([
            'name' => 'Tiny small cruise ',
            'description' => 'All first class facilities',
        ]);

        
    }
}
