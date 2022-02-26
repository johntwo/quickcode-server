<?php

namespace app\common\model;

use app\common\pluings\service\Oss;
use think\model\concern\SoftDelete;

/**
 * Class Role
 * @package app\model
 */
class Role extends ModelBase
{
    use SoftDelete;

    /**
     * 属性修改器
     */
    public function setRulesAttr($value)
    {
        return json_encode($value,JSON_UNESCAPED_UNICODE);
    }

    /**
     * 属性获取器
     */
    public function getRulesAttr($value)
    {
        return json_decode($value,true);
    }
}
