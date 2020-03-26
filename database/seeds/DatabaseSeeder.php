<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CapacityCategoryTableSeeder::class);
        $this->call(CruiseCategoryTableSeeder::class);
        $this->call(ShipTypesTableSeeder::class);
        $this->call(AmenitiesTableSeeder::class);
        $this->call(ShipsTableSeeder::class);
        
    }
}
