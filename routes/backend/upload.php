<?php


Route::middleware('auth.backend')
    ->group( function () {
        //图片上传
        Route::any('upload','UploadController@index');
    });
