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
            'secretId' => '',
            // $secretKey
            'secretKey' => '',
            // sts token 过期时间 秒
            'durationSeconds' => 1800,
            // region bucket所在的区域
            'region' => 'ap-guangzhou',
            // 默认的存储桶 名称
            'default_bucket' => '',
            // 允许的操作类型
            'allowActions' => [
                // 简单上传
                'name/cos:PutObject',
                'name/cos:PostObject'
            ]
        ]
    ],
];
