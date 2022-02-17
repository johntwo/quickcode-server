<?php

// +----------------------------------------------------------------------
// | officialaccount设置  zhangkai
// +----------------------------------------------------------------------

return [
    // 默认officialaccount驱动
    'default' => env('officialaccount.driver', 'wechat'),

    // officialaccount驱动配置
    'drivers'  => [
        // 微信驱动
        'wechat' => [
            // 类型
            'type'=>'Wechat',
            // $secretId
            'appId' => env('officialaccount.drivers-wechat-appId', ''),
            // $secretKey
            'appSecret' => env('officialaccount.drivers-wechat-appSecret', '')
        ]
    ],
];
