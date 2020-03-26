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


Auth::routes();

Route::get('amenities-grid', 'AmenityController@anyData')->name('amenities-grid');

Route::resource('amenities', 'AmenityController');

Route::get('ships-grid', 'ShipController@anyData')->name('ships-grid');

Route::resource('ships', 'ShipController');

Route::get('cruise-categories-grid', 'CruiseCategoryController@anyData')->name('cruise-categories-grid');

Route::resource('cruise-categories', 'CruiseCategoryController');

Route::get('ship-types-grid', 'ShipTypeController@anyData')->name('ship-types-grid');

Route::resource('ship-types', 'ShipTypeController');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

