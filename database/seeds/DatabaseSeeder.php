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
        $this->call(BoatClassesTableSeeder::class);
        $this->call(BoatTypesTableSeeder::class);
        $this->call(AmenitiesTableSeeder::class);
        $this->call(BoatsTableSeeder::class);
    }
}
