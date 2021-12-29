QuickCode 1.0
===============

> 运行环境要求PHP7.4+
> 

#支付驱动
##微信支付
###配置
```php
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
            'key' => ''
        ]
    ],
];

```

###调用
####下单例子
```php
Pay::order([
'body' => '腾讯充值中心-QQ会员充值',
'out_trade_no' => '201508061253466',
'total_fee' => 1,
'notify_url' => 'http://zktest.free.svipss.top/admin/wechat/payreceive', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
'trade_type' => 'JSAPI', // 请对应换成你的支付方式对应的值类型
'openid' => 'oj6Mm0ZbBNBXtTggFGhVy9t0TbW4',
]);
```
####支付成功验证
```php
Pay::paidNotify(function($message){
            // $message 是微信回调的参数，验签通过才会进入这个方法

            // 自己的验证逻辑

            return true;// 支付成功返回true，否则返回其他String信息即可
        });
```