<?php

Route::get('erabiltzaileak/loginAs/{id}', 'UsersController@loginAs')
    ->name('dev.users.loginAs');
Route::get('erabiltzaileak/logoutAs', 'UsersController@logoutAs')
    ->name('dev.users.logoutAs');
