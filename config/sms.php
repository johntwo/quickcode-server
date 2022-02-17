<?php

// +----------------------------------------------------------------------
// | 短信设置  zhangkai
// +----------------------------------------------------------------------

return [
    // 默认短信驱动
    'default' => env('sms.driver', 'alibaba'),

    // 短信驱动配置
    'drivers'  => [
        // 腾讯驱动
        'tencent' => [
            // 类型
            'type'=>'Tencent',
            // $secretId
            'secretId' => env('sms.drivers-tencent-secretId', ''),
            // $secretKey
            'secretKey' => env('sms.drivers-tencent-secretKey', ''),
            // SmsSdkAppId
            'smsSdkAppId'=> env('sms.drivers-tencent-smsSdkAppId', ''),
            // 签名信息
            'signName'=> env('sms.drivers-tencent-signName', ''),
        ],
        // 阿里巴巴驱动
        'alibaba'=>[
            // 类型
            'type'=>'Alibaba',
            // accessKeyId
            'accessKeyId'=> env('drivers-alibaba-accessKeyId', ''),
            // accessKeySecret
            'accessKeySecret'=> env('drivers-alibaba-accessKeySecret', ''),
            // 签名
            'signName'=> env('drivers-alibaba-signName', ''),
        ]
    ]
];
