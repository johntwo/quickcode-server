<?php

// +----------------------------------------------------------------------
// | oss设置  zhangkai
// +----------------------------------------------------------------------

return [
    // 默认oss驱动
    'default' => env('applet.driver', 'wechat'),

    // oss驱动配置
    'drivers'  => [
        // 腾讯驱动
        'wechat' => [
            // 类型
            'type'=>'Wechat',
            // $secretId
            'appId' => '',
            // $secretKey
            'appSecret' => ''
        ]
    ],
];
