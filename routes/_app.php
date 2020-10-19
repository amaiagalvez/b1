<?php

use Illuminate\Support\Facades\Route;

/* Home */

Route::get('/home', 'BasicsController@basicshome')
    ->name('home');

/* Users */
Route::middleware(['activityLog'])->group(function () {

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
});

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
Route::get('rolak/{id}/aktibatu', 'RolesController@activate')
    ->name('roles.activate');
Route::get('rolak/{id}/desaktibatu', 'RolesController@deactivate')
    ->name('roles.deactivate');
Route::get('rolak/ez-aktiboak', 'RolesController@nonactive')
    ->name('roles.nonactive');

/* Versions */

Route::get('bertsioak', 'VersionsController@index')
    ->name('versions.index');

/* Notifications */

Route::get('jakinarazpenak', 'NotificationsController@index')
    ->name('notifications.index');

Route::post('jakinarazpenak/{notification}', 'NotificationsController@update')
    ->name('notifications.update');

/* Menus */

Route::get('menuak', 'MenusController@index')
    ->name('menus.index');
Route::get('menuak/{id}', 'MenusController@edit')
    ->name('menus.edit');
Route::post('menuak/{id}', 'MenusController@update')
    ->name('menus.update');
