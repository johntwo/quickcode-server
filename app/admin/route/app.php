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
Route::get('Index/index$', '/admin/Index/index')->middleware(\app\admin\middleware\AuthToken::class);
Route::post('User/login$', '/admin/User/login');
// 需要登录的路由
Route::group(function(){
    Route::get('User/current', '/admin/User/current');
    Route::delete('User/logout', '/admin/User/logout');
})->middleware(\app\admin\middleware\AuthToken::class);
