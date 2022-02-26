<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: zhangkai
// +----------------------------------------------------------------------
use think\facade\Route;
Route::post('Index/index$', '/admin/Index/index')
    ->middleware(\app\admin\middleware\AuthToken::class)
    ->middleware(\app\admin\middleware\ApiPermission::class,['auth']);
Route::post('User/login$', '/admin/User/login');
// 需要登录的路由
Route::group(function(){
    // 权限
    Route::get('auth/getTree', '/admin/Auth/getTree');
    // 角色操作
    Route::get('role/getList', '/admin/Role/getList');
    Route::get('role/getOption', '/admin/Role/getOption');
    Route::post('role/add', '/admin/Role/add');
    Route::patch('role/update', '/admin/Role/update');
    Route::delete('role/del', '/admin/Role/del');
    // 用户
    Route::get('User/current', '/admin/User/current');
    Route::delete('User/logout', '/admin/User/logout');
    Route::get('user/getList', '/admin/User/getList');
    Route::post('user/add', '/admin/User/add');
    Route::patch('user/update', '/admin/User/update');
    Route::delete('user/del', '/admin/User/del');
    // oss
    Route::get('oss/getOssToken', '/admin/oss/getOssToken');
})->middleware(\app\admin\middleware\AuthToken::class);
