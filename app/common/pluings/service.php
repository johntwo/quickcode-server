<?php
/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/20   15:58
 */
return [
    'sms' => \app\common\pluings\sms\Driver::class, // 短信服务
    'oss' => \app\common\pluings\oss\Driver::class, // 对象存储服务
    'captcha' => \app\common\pluings\captcha\Driver::class, // 验证码服务
    'pay' => \app\common\pluings\pay\Driver::class, // 支付服务
    'applet' => \app\common\pluings\applet\Driver::class // 小程序服务
];