<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('amenities-grid', 'AmenityController@anyData')->name('amenities-grid');

Route::resource('amenities', 'AmenityController');

Route::get('boats-grid', 'BoatController@anyData')->name('boats-grid');

Route::resource('boats', 'BoatController');

Route::get('boat-classes-grid', 'BoatClassController@anyData')->name('boat-classes-grid');

Route::resource('boat-classes', 'BoatClassController');

Route::get('boat-types-grid', 'BoatTypeController@anyData')->name('boat-types-grid');

Route::resource('boat-types', 'BoatTypeController');

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
