<?php

namespace  app\common\pluings\service;
/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/18   11:45
 * @see \app\common\pluings\sms\Driver
 * @method static mixed getStsToken($params) 获取sts token
 * @method static mixed convertToDatabaseData($data) 序列化
 * @method static mixed convertToEntityData($data) 反序列化
 */
class Oss extends \think\Facade
{
    /**
     * 获取当前Facade对应类名（或者已经绑定的容器对象标识）
     * @access protected
     * @return string
     */
    protected static function getFacadeClass()
    {
        return 'oss';
    }
}