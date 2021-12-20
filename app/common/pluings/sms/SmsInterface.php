<?php


namespace app\common\pluings\sms;


/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/20   16:04
 */
interface SmsInterface
{
    /**
     * 发送短消息
     */
    public function send($params);
}