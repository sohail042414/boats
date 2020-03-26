<?php

use App\Ship;
use Illuminate\Database\Seeder;

class ShipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Ship::class,50)->create()->each(function($b) {
            $b->save();
        });

    }
}
