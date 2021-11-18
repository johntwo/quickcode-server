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
}
