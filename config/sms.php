<?php

// +----------------------------------------------------------------------
// | 短信设置
// +----------------------------------------------------------------------

return [
    // 默认短信驱动
    'default' => env('sms.driver', 'alibaba'),

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
            // 签名信息
            'signName'=>''
        ],
        'alibaba'=>[
            // 类型
            'type'=>'Alibaba',
            // accessKeyId
            'accessKeyId'=>'',
            // accessKeySecret
            'accessKeySecret'=>'',
            // 签名
            'signName'=>''
        ]
    ],
];
