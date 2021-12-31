QuickCode 1.0
===============

> 运行环境要求PHP7.4+
>

# 支付驱动 (Pay)

## 微信支付

### 配置

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

### 下单

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

### 支付成功验证

```php
Pay::paidNotify(function($message){
        // $message 是微信回调的参数，验签通过才会进入这个方法

        // 自己的验证逻辑

        return true;// 支付成功返回true，否则返回其他String信息即可
});
```

# 小程序驱动 (Applet)

### 配置

```php
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
```

### 获取用户信息

```php
Applet::getUserInfo($code);
```

### 获取手机号码信息
```php
Applet::getUserPhoneNumber($code);
```

# 验证码驱动（Captcha）

### 配置

```php
// +----------------------------------------------------------------------
// | 验证码设置
// +----------------------------------------------------------------------

return [
    // 验证码类型
    'type'  => [
        // 登录配置
        'login' => [
            // 长度
            'length' => 6,
            // 过期时间 秒
            'expire' => 900
        ],
        // 注册配置
        'register' => [
            // 长度
            'length' => 6,
            // 过期时间 秒
            'expire' => 900
        ],
        // 修改密码
        'change-password' => [
            // 长度
            'length' => 6,
            // 过期时间 秒
            'expire' => 900
        ]
    ]
];
```

### 生成验证码

```php
// login 是验证码类型  17754589605 是验证码对应的key  可以是手机号码和其它任何业务需要的key
// 这个方法会返回验证码，和自动按照全局配置的验证码缓存时间进行缓存
Captcha::generate('login','17754589605');
```

### 验证验证码

```php
// 方法无返回值，验证不通过会自动抛异常
Captcha::verify('login','17754589605',123456);
```

# 短信驱动（Sms）

### 配置
```php
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
            'secretId' => '',
            // $secretKey
            'secretKey' => '',
            // SmsSdkAppId
            'smsSdkAppId'=> '',
            // 签名信息
            'signName'=>''
        ],
        // 阿里巴巴驱动
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
    ]
];
```

### 发送短信

```php
// tencent 驱动方式发送短信
Sms::send([
    'phoneNumbers'=>['17751411980'], // 手机号码,可以是数组 最多200个
    'templateId'=>'1231241',         // 短信模板id
    'templateParam'=>['1025','10']   // 模板参数
]);
// alibaba 驱动
Sms::send([
      'phoneNumbers'=>['1775112345','13167221111'], // 手机号码,可以是数组 最多200个
      'templateId'=>'SMS_209195440', // 短信模板id
      'templateParam'=>['code'=>635486] // 模板参数
]);
```