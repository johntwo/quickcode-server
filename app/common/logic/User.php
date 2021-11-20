<?php


namespace app\common\logic;



use think\facade\Db;

class User extends LogicBase
{
    /**
     * 验证密码是否正确
     */
    public function verifyPassword($uid,$password):bool
    {
        $user = Db::name('user')->field('password')->find($uid);
        return password_verify($password,$user['password']);
    }
}