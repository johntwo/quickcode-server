<?php

namespace app\common\model;

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
        $this->save($data);
    }
}
