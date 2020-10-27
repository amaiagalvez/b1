<?php

use Illuminate\Support\Facades\Route;

/* States */

Route::get('estatuak', 'StatesController@index')
    ->name('states.index');
Route::get('estatuak/{id}', 'StatesController@edit')
    ->name('states.edit');
Route::post('estatuak/{id}', 'StatesController@update')
    ->name('states.update');
Route::get('estatuak/sortu', 'StatesController@create')
    ->name('states.create');
Route::post('estatuak/sortu', 'StatesController@store')
    ->name('states.store');
Route::post('estatuak/{id}/ezabatu', 'StatesController@delete')
    ->name('states.delete');
Route::get('estatuak/{id}/berreskuratu', 'StatesController@restore')
    ->name('states.restore');
Route::post('estatuak/{id}/guztiz-ezabatu', 'StatesController@destroy')
    ->name('states.destroy');
Route::get('estatuak/zakarrontzia', 'StatesController@trash')
    ->name('states.trash');
Route::get('estatuak/{id}/aktibatu', 'StatesController@activate')
    ->name('states.activate');
Route::get('estatuak/{id}/desaktibatu', 'StatesController@deactivate')
    ->name('states.deactivate');
Route::get('estatuak/ez-aktiboak', 'StatesController@nonactive')
    ->name('states.nonactive');
