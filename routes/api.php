<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

// END POINT PER API

Route::namespace('Api')->group(function() {

 // APARTMENT
 Route::get('/apartments', 'ApartmentController@index');

 Route::get('/services', 'ServiceController@index');
 
  // ROTTA SHOW DI SINGOLO APARTMENT
  Route::get('/apartments/{slug}', 'ApartmentController@show');

  Route::get('/apartments/filteredApartments/{services}', 'ApartmentController@filteredApartments');

  Route::post('/apartments/', 'ApartmentController@filter');

  // SALVATAGGIO DEI NUOVI MESSAGGI
  // Route::get('/messages', 'MessageController@index');

  Route::post('/messages', 'MessageController@store');

  Route::post('/payment-request' , 'PaymentController@payment' );
});

