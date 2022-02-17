<?php

namespace  app\common\pluings\service;
/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/18   11:45
 * @see \app\common\pluings\captcha\Driver
 * @method static mixed generate($type,$key) 生成验证码
 * @method static mixed verify($type,$key,$code) 验证验证码
 */
class Captcha extends \think\Facade
{
    /**
     * 获取当前Facade对应类名（或者已经绑定的容器对象标识）
     * @access protected
     * @return string
     */
    protected static function getFacadeClass()
    {
        return 'captcha';
    }
}