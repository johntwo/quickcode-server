<?php

namespace  app\common\pluings\service;
/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/18   11:45
 * @see \app\common\pluings\pay\Driver
 * @method static mixed order($params) 下单
 * @method static mixed query($data) 查询订单
 * @method static mixed refund($data) 订单退款
 * @method static mixed paidNotify(\Closure $closure) 支付验证
 * @method static mixed refundNotify(\Closure $closure) 退款验证
 */
class Pay extends \think\Facade
{
    /**
     * 获取当前Facade对应类名（或者已经绑定的容器对象标识）
     * @access protected
     * @return string
     */
    protected static function getFacadeClass()
    {
        return 'pay';
    }
}