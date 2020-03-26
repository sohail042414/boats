<?php

use Illuminate\Database\Seeder;

class CapacityCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('capacity_categories')->insert([
            'name' => '16 Max',
            'description' => 'Maximum 16 people and some extras',
            'min' => 0,
            'max' => 16,
        ]);

        //
        DB::table('capacity_categories')->insert([
            'name' => 'Medium up to 39',
            'description' => 'From 17 people to 39 and etc',
            'min' => 17,
            'max' => 39,
        ]);

        //
        DB::table('capacity_categories')->insert([
            'name' => 'Huge,Up to 200',
            'description' => 'From 40 people to 200 and etc',
            'min' => 40,
            'max' => 200,
        ]);

    }
}
