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


//Auth::routes();
Auth::routes(['register' => false]);

Route::get('amenities-grid', 'AmenityController@gridData')->name('amenities-grid');
Route::resource('amenities', 'AmenityController');

Route::get('ships-grid', 'ShipController@gridData')->name('ships-grid');
Route::resource('ships', 'ShipController');

Route::get('cruise-categories-grid', 'CruiseCategoryController@gridData')->name('cruise-categories-grid');
Route::resource('cruise-categories', 'CruiseCategoryController');

Route::get('capacity-categories-grid', 'CapacityCategoryController@gridData')->name('capacity-categories-grid');
Route::resource('capacity-categories', 'CapacityCategoryController');

Route::get('ship-types-grid', 'ShipTypeController@gridData')->name('ship-types-grid');
Route::resource('ship-types', 'ShipTypeController');

Route::get('ship-images-grid', 'ShipImageController@gridData')->name('ship-images-grid');
Route::resource('ship-images', 'ShipImageController')->only([
    'destroy'
]);

Route::get('users-grid', 'UserController@gridData')->name('users-grid');
Route::resource('users', 'UserController');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

