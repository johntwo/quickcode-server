<?php


namespace app\common\pluings\applet;


/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/30   15:05
 */
interface AppletInterface
{
    /**
     * 获取用户信息
     * @param string $code 小程序返回的code
     */
    public function getUserInfo($code);

    /**
     * 获取用户手机号码
     * @param string $code 小程序返回的code
     */
    public function getUserPhoneNumber($code);
}