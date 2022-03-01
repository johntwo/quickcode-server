<?php

namespace app\common\model;

use app\common\pluings\service\Oss;
use think\model\concern\SoftDelete;

/**
 * Class User
 * @package app\model
 */
class User extends ModelBase
{
    use SoftDelete;
    protected $hidden = ['password','wxopenid','wxunionid','delete_time'];

    /**
     * 新增用户
     */
    public function add($data){
        if(!empty($data['password'])){
            $data['password'] = password_hash($data['password'],1);
        }
        return $this->save($data);
    }

    /**
     * 属性修改器
     */
    public function setAvatorAttr($value)
    {
        return Oss::convertToDatabaseData($value);
    }

    /**
     * 属性获取器
     */
    public function getAvatorAttr($value)
    {
        return Oss::convertToEntityData($value);
    }

    /**
     * 用户角色一对一
     */
    public function roles()
    {
        return $this->hasOne(UserRole::class,'uid','id')->bind(['roles']);
    }

}
