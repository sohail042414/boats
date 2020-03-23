<?php

use App\Boat;
use Illuminate\Database\Seeder;

class BoatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Boat::class,50)->create()->each(function($b) {
            $b->save();
        });

    }
}
