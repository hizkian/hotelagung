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



Route::group(['middleware' => 'disablepreventback'],function(){
  Auth::routes();

  Route::middleware(['auth'])->group(function () {


      Route::prefix('reservation')->group(function () {
          Route::get('/create/', 'HomeController@createReservation');
          Route::post('/create/', 'HomeController@createReservationData');
          Route::get('/', 'HomeController@indexReservation');
          Route::get('/checkout/{id}/', 'HomeController@checkoutReservation');
          Route::post('/checkout/', 'HomeController@checkoutReservationData');
      });

      Route::prefix('room')->group(function () {
          Route::get('/add/', 'HomeController@addRoom');
          Route::post('/add/', 'HomeController@createRoomData');
          Route::get('/delete/{id}/', 'HomeController@deleteRoom');
          Route::get('/edit/{id}/', 'HomeController@editRoom');
          Route::get('/', 'HomeController@indexRoom');
          Route::post('/edit/', 'HomeController@editRoomData');
      });

      Route::prefix('customer')->group(function () {
          Route::get('/', 'HomeController@indexCustomer');
          Route::get('/delete/{id}/', 'HomeController@deleteCustomer');
          Route::get('/edit/{id}/', 'HomeController@editCustomer');
          Route::post('/edit/', 'HomeController@editCustomerData');
          Route::get('/dailyreport/', 'HomeController@dailyReport');
      });

      Route::prefix('additional')->group(function () {
          Route::get('/', 'HomeController@indexAdditional');
          Route::get('/add/', 'HomeController@addAdditional');
          Route::post('/add/', 'HomeController@createAdditionalData');
          Route::get('/delete/{id}/', 'HomeController@deleteAdditional');
          Route::get('/edit/{id}/', 'HomeController@editAdditional');
          Route::post('/edit/', 'HomeController@editAdditionalData');
      });

      Route::prefix('invoice')->group(function () {
          Route::get('/', 'HomeController@indexInvoice');
          Route::get('/print/{id}/', 'HomeController@printInvoice');
      });

      Route::prefix('report')->group(function () {
          Route::get('/monthly', 'HomeController@indexReport');
          Route::get('/print/{id}/', 'HomeController@printReport');
          Route::get('/daily','HomeController@filteredReport');
          Route::get('/filter','HomeController@printFilteredReport');
          Route::get('/customer','HomeController@printAllCustomer');
      });

  });
});

Route::get('/home', function(){
  return redirect('/reservation/');
});

Route::get('iseng', function(){
  return view('report/filter');
});
