<?php

Route::namespace('Home')
    ->middleware('auth.backend')
    ->group( function () {
        //控制台主页
        Route::get('console','HomeController@console');
        //主页示例模板一
        Route::get('homepage1','HomeController@homepage1');
        //主页示例模板二
        Route::get('homepage2','HomeController@homepage2');
    });
