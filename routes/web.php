<?php

use Illuminate\Support\Facades\Route;

/* Login */

Auth::routes(['verify' => true]);

Route::get('login/{service}', 'Auth\SocialLoginController@redirectTo')->name('login.social')->middleware('guest');
Route::get('login/{service}/callback', 'Auth\SocialLoginController@handleCallback')->middleware('guest');

/* Notifications */

Route::get('jakinarazpenak', 'NotificationsController@index')
     ->name('admin.notifications.index')
     ->middleware([
         'web',
         'auth',
         'userLanguage'
     ]);

Route::post('jakinarazpenak/{notification}','NotificationsController@update')
     ->name('admin.notifications.update')
     ->middleware([
         'web',
         'auth',
         'userLanguage'
     ]);
