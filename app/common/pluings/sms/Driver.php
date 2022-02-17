<?php

namespace app\common\pluings\sms;

use think\helper\Str;
use think\Manager;

/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/20   15:42
 */
class Driver extends Manager
{

    protected $namespace = '\\app\\common\\pluings\\sms\\driver\\';

    public function getDefaultDriver()
    {
        return $this->getConfig('default');
    }

    /**
     * 获取短信配置
     * @access public
     * @param null|string $name    名称
     * @param mixed       $default 默认值
     * @return mixed
     */
    public function getConfig(string $name = null, $default = null)
    {
        if (!is_null($name)) {
            return $this->app->config->get('sms.' . $name, $default);
        }

        return $this->app->config->get('sms');
    }

    /**
     * 获取驱动类型
     * @param string $name
     * @return mixed
     */
    protected function resolveType(string $name)
    {
        return $this->getConfig("drivers.{$name}.type");
    }

    /**
     * 获取驱动配置
     * @param string $name
     * @return mixed
     */
    protected function resolveConfig(string $name)
    {
        return $this->getConfig("drivers.{$name}");
    }

    /**
     * 获取驱动实例
     * @param null|string $name
     * @return mixed
     */
    protected function driver(string $name = null):SmsInterface
    {
        return parent::driver($name);
    }

    /**
     * 发送短信
     */
    public function send($params):SendResult
    {
        return $this->driver()->send($params);
    }
}