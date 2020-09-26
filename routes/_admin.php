<?php

use Illuminate\Support\Facades\Route;

/* Home */

Route::get('/admin', function () {
    return 'Home Users package. Hello ' . auth()->user()->name;
})->name('home');

/* Users */

Route::get('erabiltzaileak', 'UsersController@index')
    ->name('users.index');
Route::get('erabiltzaileak/profila', 'UsersController@profile')
    ->name('users.profile');
Route::get('erabiltzaileak/{id}', 'UsersController@edit')
    ->name('users.edit');
Route::post('erabiltzaileak/{id}', 'UsersController@update')
    ->name('users.update');
Route::get('erabiltzaileak/sortu', 'UsersController@create')
    ->name('users.create');
Route::post('erabiltzaileak/sortu', 'UsersController@store')
    ->name('users.store');
Route::post('erabiltzaileak/{id}/ezabatu', 'UsersController@delete')
    ->name('users.delete');
Route::get('erabiltzaileak/{id}/berreskuratu', 'UsersController@restore')
    ->name('users.restore');
Route::post('erabiltzaileak/{id}/guztiz-ezabatu', 'UsersController@destroy')
    ->name('users.destroy');
Route::get('erabiltzaileak/zakarrontzia', 'UsersController@trash')
    ->name('users.trash');
Route::get('erabiltzaileak/{id}/aktibatu', 'UsersController@activate')
    ->name('users.activate');
Route::get('erabiltzaileak/{id}/desaktibatu', 'UsersController@deactivate')
    ->name('users.deactivate');
Route::get('erabiltzaileak/ez-aktiboak', 'UsersController@nonactive')
    ->name('users.nonactive');

/* Variables */

Route::get('aldagaiak', 'VariablesController@index')
    ->name('variables.index');
Route::get('aldagaiak/{id}', 'VariablesController@edit')
    ->name('variables.edit');
Route::post('aldagaiak/{id}', 'VariablesController@update')
    ->name('variables.update');

/* Sessions */

Route::get('saioak', 'SessionsController@index')
    ->name('sessions.index');

/* Roles */

Route::get('rolak', 'RolesController@index')
    ->name('roles.index');
Route::get('rolak/{id}', 'RolesController@edit')
    ->name('roles.edit');
Route::post('rolak/{id}', 'RolesController@update')
    ->name('roles.update');
Route::get('rolak/sortu', 'RolesController@create')
    ->name('roles.create');
Route::post('rolak/sortu', 'RolesController@store')
    ->name('roles.store');
Route::post('rolak/{id}/ezabatu', 'RolesController@delete')
    ->name('roles.delete');
Route::get('rolak/{id}/berreskuratu', 'RolesController@restore')
    ->name('roles.restore');
Route::post('rolak/{id}/guztiz-ezabatu', 'RolesController@destroy')
    ->name('roles.destroy');
Route::get('rolak/zakarrontzia', 'RolesController@trash')
    ->name('roles.trash');

/* Versions */

Route::get('bertsioak', 'VersionsController@show')
    ->name('versions.show');

/* Notifications */

Route::get('jakinarazpenak', 'NotificationsController@index')
    ->name('notifications.index')
    ->middleware([
        'web',
        'auth',
        'userLang'
    ]);

Route::post('jakinarazpenak/{notification}', 'NotificationsController@update')
    ->name('notifications.update')
    ->middleware([
        'web',
        'auth',
        'userLang'
    ]);
