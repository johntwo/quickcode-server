<?php

namespace  app\common\pluings\service;
/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/18   11:45
 * @see \app\common\pluings\sms\Driver
 * @method static mixed send($params) 发送短信
 */
class Sms extends \think\Facade
{
    /**
     * 阿里巴巴 调用样例
     * \app\common\pluings\service\Sms::send([
      'phoneNumbers'=>['1775112345','13167221111'],
      'templateId'=>'SMS_209196440',
      'templateParam'=>['code'=>10]
    ])
     *
     * 腾讯调用样例
     * \app\common\pluings\service\Sms::send([
    'phoneNumbers'=>['17751411980'],
    'templateId'=>'1231241',
    'templateParam'=>['1025','10']
    ])
     */

    /**
     * 获取当前Facade对应类名（或者已经绑定的容器对象标识）
     * @access protected
     * @return string
     */
    protected static function getFacadeClass()
    {
        return 'sms';
    }
}