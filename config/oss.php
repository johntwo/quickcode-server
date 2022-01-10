<?php

// +----------------------------------------------------------------------
// | oss设置  zhangkai
// +----------------------------------------------------------------------

return [
    // 默认oss驱动
    'default' => env('oss.driver', 'tencent'),

    // oss驱动配置
    'drivers'  => [
        // 腾讯驱动
        'tencent' => [
            // 类型
            'type'=>'Tencent',
            // $secretId
            'secretId' => env('oss.drivers-tencent-secretId', ''),
            // $secretKey
            'secretKey' => env('oss.drivers-tencent-secretKey', ''),
            // sts token 过期时间 秒
            'durationSeconds' => env('oss.drivers-tencent-durationSeconds', ''),
            // region bucket所在的区域
            'region' => env('oss.drivers-tencent-region', ''),
            // 默认的存储桶 名称
            'default_bucket' => env('oss.drivers-tencent-default_bucket', ''),
            // 允许的操作类型
            'allowActions' => explode(',',env('oss.drivers-tencent-allowActions', ''))
        ]
    ],
];
