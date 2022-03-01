<?php

namespace app\common\model;

use app\common\pluings\service\Oss;
use think\model\concern\SoftDelete;

/**
 * Class UserRole
 * @package app\model
 */
class UserRole extends ModelBase
{
    use SoftDelete;

    /**
     * 属性修改器
     */
    public function setRolesAttr($value)
    {
        return json_encode($value);
    }

    /**
     * 属性获取器
     */
    public function getRolesAttr($value)
    {
        return json_decode($value,true);
    }
}
