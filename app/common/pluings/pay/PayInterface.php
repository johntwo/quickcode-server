<?php


namespace app\common\pluings\pay;


/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/29   14:09
 */
interface PayInterface
{
    /**
     * 下单
     */
    public function order($params);

    /**
     * 验证是否支付成功
     */
    public function paidNotify(\Closure $closure);


    /**
     * 查询
     */
    public function query($params);

    /**
     * 退款
     */
    public function refund($params);

    /**
     * 验证是否退款成功
     */
    public function refundNotify(\Closure $closure);
}