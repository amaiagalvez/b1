<?php

use Illuminate\Support\Facades\Route;

/* Login */

Auth::routes(['verify' => true]);

Route::get('login/{service}', 'Auth\SocialLoginController@redirectTo')
    ->name('login.social')
    ->middleware('guest');
Route::get('login/{service}/callback', 'Auth\SocialLoginController@handleCallback')
    ->middleware('guest');

/* Home */

Route::get('/home', function () {
    return 'Home Public Front';
})->name('front.home');

