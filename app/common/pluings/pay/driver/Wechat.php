<?php


namespace app\common\pluings\pay\driver;

use app\common\pluings\pay\PayInterface;
use app\common\pluings\utils\Cache;
use app\common\pluings\utils\EasyWechatLog;
use app\common\utils\UtilsLog;
use EasyWeChat\Factory;
use think\App;

/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/21   15:05
 */
class Wechat implements PayInterface
{
    use Cache;

    protected $options = [
        // 类型
        'type' => 'Wechat'
    ];

    protected $app = null;

    /**
     * 架构函数
     * @param App $app
     * @param array $options 参数
     */
    public function __construct(App $app, array $options = [])
    {
        if (!empty($options)) {
            $this->options = array_merge($this->options, $options);
        }

        $this->app = Factory::payment([
            'app_id' => $this->options['app_id'],
            'mch_id' => $this->options['mch_id'],
            'key' => $this->options['key'],
        ]);
        $this->app->rebind('logger', new EasyWechatLog());
    }

    public function order($params)
    {
        // 验证参数是否足够
        $this->validOrderParams($params);

//        [
//            'body' => '腾讯充值中心-QQ会员充值',
//            'out_trade_no' => '201508061253466',
//            'total_fee' => 1,
//            'notify_url' => 'http://zktest.free.svipss.top/admin/wechat/payreceive', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
//            'trade_type' => 'JSAPI', // 请对应换成你的支付方式对应的值类型
//            'openid' => 'oj6Mm0ZbBNBXtTggFGhVy9t0TbW4',
//        ]
        empty($params['trade_type']) && $params['trade_type'] = 'JSAPI';
        // 统一下单
        $result = $this->app->order->unify($params);

        if(empty($result['prepay_id'])){
            exception($result['err_code_des']);
        }

        // 返回支付的参数
        return $this->app->jssdk->bridgeConfig($result['prepay_id'], false);;
    }

    /**
     * @param $params
     * 验证创建订单参数是否全面
     */
    public function validOrderParams($params){

        empty($params['body']) && exception("订单参数不全");
        empty($params['out_trade_no']) && exception("订单参数不全");
        empty($params['total_fee']) && exception("订单参数不全");
        empty($params['notify_url']) && exception("订单参数不全");
        empty($params['trade_type']) && exception("订单参数不全");
        empty($params['openid']) && exception("订单参数不全");

    }

    public function query($params)
    {
        exception('暂不支持订单查询');
    }

    public function refund($params)
    {
        exception('暂不支持订单退款');
    }

    public function paidNotify(\Closure $closure)
    {
        $response = $this->app->handlePaidNotify($closure);

        return $response;
    }
}