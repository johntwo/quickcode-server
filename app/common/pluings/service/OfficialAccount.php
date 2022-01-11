<?php

namespace  app\common\pluings\service;
/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/18   11:45
 * @see \app\common\pluings\officialaccount\Driver
 * @method static mixed sendTemplateMessage($params) 发送模板消息
 * @method static \EasyWeChat\OfficialAccount\Application getOfficialAccount() 获取公众号对象
 */
class OfficialAccount extends \think\Facade
{
    /**
     * 获取当前Facade对应类名（或者已经绑定的容器对象标识）
     * @access protected
     * @return string
     */
    protected static function getFacadeClass()
    {
        return 'officialaccount';
    }
}