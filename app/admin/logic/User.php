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
        empty($data['username']) && exception('用户名不能为空');
        empty($data['password']) && exception('密码不能为空');

        $user = \app\common\model\User::where('username',$data['username'])->find();
        !empty($user) && exception('用户不存在');

        $commonLogicUser = new \app\common\logic\User();
        $commonLogicUser->verifyPassword($user['id'],$data['password']) && exception('用户密码不正确');

        $token = Auth::buildToken($user['id']);
        $loginCacheInfo = [
            'id'=>$user['id'],
            'token_uuid'=>$token['uuid']
        ];

        cache(CacheKey::loginAdminToken()->key([$user['id']]),$loginCacheInfo);
        return ['token'=>$token['token']];
    }
}