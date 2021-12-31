<?php

// +----------------------------------------------------------------------
// | applet设置  zhangkai
// +----------------------------------------------------------------------

return [
    // 默认applet驱动
    'default' => env('applet.driver', 'wechat'),

    // applet驱动配置
    'drivers'  => [
        // 微信驱动
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
