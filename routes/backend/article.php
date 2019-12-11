<?php


Route::namespace('Article')
    ->middleware('auth.backend')
    ->group( function () {
        //文章
        Route::resource('article','ArticleController');
        //批量删除
        Route::post('batch','ArticleController@batch');
        //分类
        Route::resource('category','CategoryController');
        //语言
        Route::resource('language','LanguageController');

    });
