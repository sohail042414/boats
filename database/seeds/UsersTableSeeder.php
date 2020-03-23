<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234')
        ]);

                //
        DB::table('users')->insert([
            'name' => 'sohail',
            'email' => 'sohail@gmail.com',
            'password' => Hash::make('sohail24')
        ]);
    }
}
