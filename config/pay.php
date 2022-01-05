<?php

// +----------------------------------------------------------------------
// | 支付设置  zhangkai
// +----------------------------------------------------------------------

return [
    // 默认支付驱动
    'default' => env('pay.driver', 'wechat'),

    // 支付驱动配置
    'drivers'  => [
        // 微信驱动
        'wechat' => [
            // 类型
            'type'=>'Wechat',
            // 小程序 app_id
            'app_id' => '',
            // 商户id
            'mch_id' => '',
            // 商户 API 秘钥
            'key' => '',
            // 商户 API 证书， apiclient_cert.pem 的绝对路径
            'cert_path' => '',
            // 商户 API 证书， apiclient_key.pem 的绝对路径
            'key_path' => ''
        ]
    ],
];
