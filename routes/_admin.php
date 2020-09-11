<?php

use Illuminate\Support\Facades\Route;

/* Users */

Route::get('erabiltzaileak', 'UsersController@index')
     ->name('admin.users.index');
Route::get('erabiltzaileak/profila', 'UsersController@profile')
     ->name('admin.users.profile');
Route::get('erabiltzaileak/{id}', 'UsersController@edit')
     ->name('admin.users.edit');
Route::post('erabiltzaileak/{id}', 'UsersController@update')
     ->name('admin.users.update');
Route::get('erabiltzaileak/sortu', 'UsersController@create')
     ->name('admin.users.create');
Route::post('erabiltzaileak/sortu', 'UsersController@store')
     ->name('admin.users.store');
Route::post('erabiltzaileak/{id}/ezabatu', 'UsersController@delete')
     ->name('admin.users.delete');
Route::get('erabiltzaileak/{id}/berreskuratu', 'UsersController@restore')
     ->name('admin.users.restore');
Route::post('erabiltzaileak/{id}/guztiz-ezabatu', 'UsersController@destroy')
     ->name('admin.users.destroy');
Route::get('erabiltzaileak/zakarrontzia', 'UsersController@trash')
     ->name('admin.users.trash');
Route::get('erabiltzaileak/{id}/aktibatu', 'UsersController@activate')
     ->name('admin.users.activate');
Route::get('erabiltzaileak/{id}/desaktibatu', 'UsersController@deactivate')
     ->name('admin.users.deactivate');
Route::get('erabiltzaileak/ez-aktiboak', 'UsersController@nonactive')
     ->name('admin.users.nonactive');

/* Variables */

Route::get('aldagaiak', 'VariablesController@index')
     ->name('admin.variables.index');
Route::get('aldagaiak/{id}', 'VariablesController@edit')
     ->name('admin.variables.edit');
Route::post('aldagaiak/{id}', 'VariablesController@update')
     ->name('admin.variables.update');

/* Sessions */

Route::get('saioak', 'SessionsController@index')
     ->name('admin.sessions.index');

/* Roles */

Route::get('rolak', 'RolesController@index')
     ->name('admin.roles.index');
Route::get('rolak/{id}', 'RolesController@edit')
     ->name('admin.roles.edit');
Route::post('rolak/{id}', 'RolesController@update')
     ->name('admin.roles.update');
Route::get('rolak/sortu', 'RolesController@create')
     ->name('admin.roles.create');
Route::post('rolak/sortu', 'RolesController@store')
     ->name('admin.roles.store');
Route::post('rolak/{id}/ezabatu', 'RolesController@delete')
     ->name('admin.roles.delete');
Route::get('rolak/{id}/berreskuratu', 'RolesController@restore')
     ->name('admin.roles.restore');
Route::post('rolak/{id}/guztiz-ezabatu', 'RolesController@destroy')
     ->name('admin.roles.destroy');
Route::get('rolak/zakarrontzia', 'RolesController@trash')
     ->name('admin.roles.trash');

/* Versions */

Route::get('bertsioak', 'VersionsController@show')
     ->name('admin.versions.show');

