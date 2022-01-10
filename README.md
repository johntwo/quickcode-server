QuickCode 1.0
===============

> 1、运行环境要求PHP7.4+
> 
> 2、基于thinkphp6开发

# 环境配置
根据不同的环境读取不同的配置文件

###配置php.ini ,在文件的最后一行加上
```ini
env = local
;env = production
```
### 以上配置会读取项目根目录下的 .env.local 作为配置

# 支付驱动 (Pay)

## 微信支付

### 配置

```ini
[pay]
driver = wechat
drivers-wechat-app_id = ''
;商户id
drivers-wechat-mch_id = ''
;商户平台的api key
drivers-wechat-key = ''
; 证书路径，退款需要指定绝对路径
drivers-wechat-cert_path = ''
; 证书路径，退款需要指定绝对路径
drivers-wechat-key_path = ''
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

### 退款
```php
Pay::refund([
            'transaction_id'=>'4200001376202201057466511986',
            'out_refund_no'=>'202103030303',
            'total_fee'=>0.01,
            'refund_fee'=>0.01,
            'notify_url'=>'http://zktest.free.svipss.top/admin/index/refund'
]);
```

### 退款回调
```php
Pay::refundNotify(function($message, $reqInfo, $fail){
            // 其中 $message['req_info'] 获取到的是加密信息
            // $reqInfo 为 message['req_info'] 解密后的信息

            // 自己的验证逻辑

            return true;// 支付成功返回true，否则返回其他String信息即可
});
```

# 小程序驱动 (Applet)

### 配置

```ini
[applet]
driver = wechat
drivers-wechat-appId = ''
drivers-wechat-appSecret = ''
```

### 获取用户信息

```php
Applet::getUserInfo($code);
```

### 获取手机号码信息
```php
Applet::getUserPhoneNumber($code);
```

### 获取access_token
```php
Applet::getAccessToken();
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
```ini
[sms]
driver = alibaba
drivers-alibaba-accessKeyId= ''
drivers-alibaba-accessKeySecret= ''
drivers-alibaba-signName= ''

drivers-tencent-secretId= ''
drivers-tencent-secretKey= ''
drivers-tencent-smsSdkAppId= ''
drivers-tencent-signName= ''
```

### 发送短信

```php
// tencent 驱动
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