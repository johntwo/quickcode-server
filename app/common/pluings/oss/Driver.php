<?php

namespace app\common\pluings\oss;

use think\helper\Str;
use think\Manager;

/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/20   15:42
 */
class Driver extends Manager
{

    protected $namespace = '\\app\\common\\pluings\\oss\\driver\\';

    public function getDefaultDriver()
    {
        return $this->getConfig('default');
    }

    /**
     * 获取oss配置
     * @access public
     * @param null|string $name    名称
     * @param mixed       $default 默认值
     * @return mixed
     */
    public function getConfig(string $name = null, $default = null)
    {
        if (!is_null($name)) {
            return $this->app->config->get('oss.' . $name, $default);
        }

        return $this->app->config->get('oss');
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
    protected function driver(string $name = null)
    {
        return parent::driver($name);
    }
}