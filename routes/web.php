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

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('reservation')->group(function () {
        Route::get('/create', 'HomeController@createReservation');
        Route::post('/create', 'HomeController@createReservationData');
        Route::get('/', 'HomeController@indexReservation');
        Route::get('/checkout/{id}', 'HomeController@checkoutReservation');
        Route::post('/checkout', 'HomeController@checkoutReservationData');
    });

    Route::prefix('room')->group(function () {
        Route::get('/add', 'HomeController@addRoom');
        Route::post('/add', 'HomeController@createRoomData');
        Route::get('/delete/{id}', 'HomeController@deleteRoom');
        Route::get('/', 'HomeController@indexRoom');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/', 'HomeController@indexCustomer');
        Route::get('/delete/{id}', 'HomeController@deleteCustomer');
    });

    Route::prefix('additional')->group(function () {
        Route::get('/', 'HomeController@indexAdditional');
        Route::get('/add', 'HomeController@addAdditional');
        Route::post('/add', 'HomeController@createAdditionalData');
        Route::get('/delete/{id}', 'HomeController@deleteAdditional');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@indexReservation');
