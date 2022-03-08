<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\HomeController;
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

             Route::get('/messages', 'MessageController@index')->name('messages');
         });

// Home front 
   Route::get('{any?}', function () {
         return view('guests.home');
          })->where('any', '.*'); 
