<?php
use app\ExceptionHandle;
use app\Request;

// 容器Provider定义文件
return array_merge([
    'think\Request'          => Request::class,
    'think\exception\Handle' => ExceptionHandle::class
],include 'common/pluings/service.php');
