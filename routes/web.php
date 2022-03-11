<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\HomeController;

use Illuminate\Support\Facades\DB;
use App\Apartment;
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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

/* Route::get('/home', 'HomeController@index')->name('home'); */

// Admin homepage
  Route::middleware('auth')
         ->namespace('Admin')
         ->name('admin.')
         ->prefix('admin')
         ->group(function(){
             Route::get('/', 'HomeController@index')->name('home');
             
             // Apartments resource routes
             Route::resource('/apartments', 'ApartmentController');
             //  Route::get('/apartments/client/ip', [HomeController::class, 'getIp']);
             
             Route::get('/sponsorships', 'SponsorshipController@index')->name('sponsorships');
             
             //  Route::get('/messages', 'MessageController@index')->name('messages');
             //  Route::delete('/messages/{message}/delete', 'MessageController@destroy');
             Route::resource('/messages', 'MessageController');
             
             Route::get('sponsorship/checkout' , function(){
                 return view('admin.sponsorships.checkout');
             })->name('checkout');
         });



    // Route::get('/test', function(){
    // /*         $apartments = DB::table('apartment_service')->join('apartments', 'apartments.id', '=', 'apartment_service.apartment_id')
    //     ->groupBy('apartment_id')
    //     ->get(); */
    // /* $apartments = Apartment::with('services')->get(); */

    //     $filtersArray = [1, 2, 3];

    //     $apartmentsFilteredByServices = DB::table('apartment_service')
    //         ->whereIn('service_id', $filtersArray)
    //         ->select('apartment_id', DB::raw('count(id)') )
    //         ->groupBy('apartment_id')
    //         ->having('count(id)' , count($filtersArray))
    //         ->get();

    //     $idApartmentArray = [];
    //     foreach ($apartmentsFilteredByServices as $apartment) {
    //         $idApartmentArray[] = $apartment->apartment_id;
    //     }
    //     // $countIdApartment = array_count_values($idApartmentArray);

    //     // $apartmentSelected = [];
    //     // foreach ($countIdApartment as $key => $value) {

    //     //     if ($value == count($filtersArray) ) {
    //     //         $apartmentSelected[] = $key;
    //     //     }
    //     // }

    //     $apartments = Apartment::with('services')
    //                 ->whereIn('id', $idApartmentArray)->get();
    // });

// Home front 
   Route::get('{any?}', function () {
         return view('guests.home');
          })->where('any', '.*'); 
