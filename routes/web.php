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

Auth::routes(['register' => false]);
//Auth::routes();

Route::middleware(['auth'])->group(function () {

    //amenities
    Route::get('amenities-grid', 'AmenityController@gridData')->name('amenities-grid');
    Route::resource('amenities', 'AmenityController');

    //ships
    Route::get('ships-grid', 'ShipController@gridData')->name('ships-grid');
    Route::resource('ships', 'ShipController');
    
    Route::get('ship-images-grid', 'ShipImageController@gridData')->name('ship-images-grid');
    Route::resource('ship-images', 'ShipImageController')->only([
        'destroy'
    ]);
    //cruise categories
    Route::get('cruise-categories-grid', 'CruiseCategoryController@gridData')->name('cruise-categories-grid');
    Route::resource('cruise-categories', 'CruiseCategoryController');

    //capacity categories
    Route::get('capacity-categories-grid', 'CapacityCategoryController@gridData')->name('capacity-categories-grid');
    Route::resource('capacity-categories', 'CapacityCategoryController');
    
    //ship types
    Route::get('ship-types-grid', 'ShipTypeController@gridData')->name('ship-types-grid');
    Route::resource('ship-types', 'ShipTypeController');

    //animals
    Route::get('animals-grid', 'AnimalController@gridData')->name('animals-grid');
    Route::resource('animals', 'AnimalController');

    Route::get('animal-images-grid', 'AnimalImageController@gridData')->name('animal-images-grid');
    Route::resource('animal-images', 'AnimalImageController')->only([
        'destroy'
    ]);

    //islands
    Route::get('islands-grid', 'IslandController@gridData')->name('islands-grid');
    Route::resource('islands', 'IslandController');

    Route::get('island-images-grid', 'IslandImageController@gridData')->name('island-images-grid');
    Route::resource('island-images', 'IslandImageController')->only([
        'destroy'
    ]);

    //islands
    Route::get('spots-grid', 'SpotController@gridData')->name('spots-grid');
    Route::resource('spots', 'SpotController');

    Route::get('spot-images-grid', 'SpotImageController@gridData')->name('spot-images-grid');
    Route::resource('spot-images', 'SpotImageController')->only([
        'destroy'
    ]);

    Route::get('itineraries-grid', 'ItineraryController@gridData')->name('itineraries-grid');
    Route::resource('itineraries', 'ItineraryController');

    Route::get('tours-grid', 'TourController@gridData')->name('tours-grid');
    Route::resource('tours', 'TourController');

    //users
    Route::get('users-grid', 'UserController@gridData')->name('users-grid');
    Route::get('users/{id}/change-password', 'UserController@changePassword');
    Route::put('users/change-password/{id}', 'UserController@updatePassword');
    Route::resource('users', 'UserController');
    

    //default
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

});