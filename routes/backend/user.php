<?php


Route::namespace('User')
    ->middleware('auth.backend')
    ->group( function () {
        //用户基本资料
        Route::get('info','UserController@info');
        //用户信息修改
        Route::post('infoEdit','UserController@infoEdit');
        //修改密码
        Route::get('password','UserController@password');
        //密码修改
        Route::post('passwordEdit','UserController@passwordEdit');
        //用户列表
        Route::get('userList','UserController@userList');
        //用户编辑
        Route::get('userEditForm','UserController@userEditForm');
        //管理员列表
        Route::get('adminUserList','UserController@adminUserList');
        //管理员编辑
        Route::get('adminUserEditForm','UserController@adminUserEditForm');
        //角色
        Route::resource('role','RoleController');
        //用户  管理员  列表
        Route::get('listApi','UserController@listApi');
        //用户  管理员  删除
        Route::post('delApi','UserController@delApi');
        //用户  管理员  批量删除
        Route::get('batchDelApi','UserController@batchDelApi');
        //用户  管理员  添加
        Route::post('createApi','UserController@createApi');
        //用户  管理员  编辑
        Route::post('editApi','UserController@editApi');

    });
