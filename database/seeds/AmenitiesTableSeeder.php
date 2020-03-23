<?php

use Illuminate\Database\Seeder;

class AmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'name' => 'German guide possible',
            ],
            [
                'name' => 'French guide possible',
            ],
            [
                'name' => 'Triple cabins',
            ],
            [
                'name' => 'Kayaks on board',
            ],
            [
                'name' => 'Doctor on board',
            ],
            [
                'name' => 'Snorkel gear (free)',
            ],
            [
                'name' => 'Water, Coffee, Tea & fresh juices',
            ],
            [
                'name' => 'Sundeck with jacuzzi',
            ],
            [
                'name' => 'Gym on board',
            ],
            [
                'name' => '100% CO2 carbon footprint offset',
            ],
            [
                'name' => 'All meals throughout the cruise',
            ],
            [
                'name' => 'Interconnecting cabins',
            ],
            [
                'name' => 'Internet / WIFI',
            ],
            [
                'name' => 'Private Balcony',
            ],
            [
                'name' => 'Transfers to and from ship',
            ],
            [
                'name' => 'Wetsuits',
            ],
            [
                'name' => 'Standup paddle boards',
            ],
            [
                'name' => '1 free night in hotel prior to flight',
            ],
            [
                'name' => 'Air conditioning & private bathroom',
            ],
            [
                'name' => 'English guide',
            ],
            [
                'name' => 'Airfare tickets',
            ],
            [
                'name' => 'Crew and guide tips',
            ],
            [
                'name' => '$20 transit control card',
            ],
            [
                'name' => '2% Credit Card fees',
            ],
            [
                'name' => 'Alcoholic drinks & bottled beverages',
            ],
            [
                'name'  => '$100 national park entrance fee'
            ]
        ];

        //insert
        DB::table('amenities')->insert($data);

    }
}
