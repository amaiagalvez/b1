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

Route::middleware(['web', 'auth', 'userLang', 'admin'])->group(function () {

    Route::get('/', 'HomeController@home')
        ->name('front.home');

    Route::get('/home', 'HomeController@home')
        ->name('home');

});
