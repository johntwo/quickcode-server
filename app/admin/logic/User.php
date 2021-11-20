<?php


namespace app\admin\logic;


use app\common\config\cache\CacheKey;
use app\common\utils\Auth;

class User extends LogicBase
{
    /**
     *  登录管理端
     */
    public function login($data){
        assert(!empty($data['username']),'用户名不能为空');
        assert(!empty($data['password']),'密码不能为空');

        $user = \app\common\model\User::where('username',$data['username'])->find();
        assert(!empty($user),'用户不存在');

        $commonLogicUser = new \app\common\logic\User();
        assert($commonLogicUser->verifyPassword($user['id'],$data['password']),'用户密码不正确');

        $token = Auth::buildToken($user['id']);
        $tokenObj = $user;
        $user['token_uuid'] = $token['uuid'];


        cache(CacheKey::loginAdminToken()->key([$user['id']]),null);
        cache(CacheKey::loginAdminToken()->key([$user['id']]),$tokenObj);
        return ['token'=>$token['token']];
    }
}