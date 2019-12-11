<?php


Route::middleware('auth.backend')
    ->group( function () {
        //后台首页
        Route::get('index','IndexController@index');
    });
