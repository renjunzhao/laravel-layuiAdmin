<?php


Route::namespace('System')
    ->middleware('auth.backend')
    ->group( function () {
        //系统设置
        Route::resource('system','SystemController');
        //菜单设置
        Route::resource('menu','MenuController');
        //短信
        Route::resource('sms','SmsController');
        //微信
        Route::resource('wechat','WechatController');
    });
