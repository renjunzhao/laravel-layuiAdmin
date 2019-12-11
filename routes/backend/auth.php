<?php


Route::namespace('Auth')
    ->prefix('auth')
    ->group( function () {

        Route::post('login', 'LoginController@login');
        Route::get('logout', 'LoginController@logout');
        Route::post('refresh', 'LoginController@refresh');
});
Route::namespace('Auth')
    ->group( function () {
        Route::get('/','LoginController@index');
});

