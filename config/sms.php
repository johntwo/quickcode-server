<?php

// +----------------------------------------------------------------------
// | 短信设置
// +----------------------------------------------------------------------

return [
    // 默认短信驱动
    'default' => env('sms.driver', 'tencent'),

    // 短信驱动配置
    'drivers'  => [
        // 腾讯短信
        'tencent' => [
            // 类型
            'type'=>'Tencent',
            // $secretId
            'secretId' => '',
            // $secretKey
            'secretKey' => '',
            // SmsSdkAppId
            'smsSdkAppId'=> '',
            // 是否记录日志
            'isLog'=>false,
            // 签名信息
            'signName'=>'送炭信息科技'
        ]
    ],
];
