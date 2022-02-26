<?php


namespace app\admin\logic;


use app\common\config\cache\CacheKey;
use app\common\config\Client;
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
        empty($user) && exception('用户不存在');

        $commonLogicUser = new \app\common\logic\User();
        !$commonLogicUser->verifyPassword($user['id'],$data['password']) && exception('用户密码不正确');

        $token = Auth::buildToken($user['id']);
        $loginCacheInfo = [
            'id'=>$user['id'],
            'token_uuid'=>$token['uuid']
        ];

        cache(CacheKey::loginAdminToken()->key([$user['id']]),$loginCacheInfo);
        return ['token'=>$token['token']];
    }

    /**
     * 获取当前登录用户信息
     */
    public function current($userInfo){
        return \app\common\model\User::find($userInfo->id);
    }

    /**
     * 登出
     */
    public function logout($userInfo){
        cache(CacheKey::loginAdminToken()->key([$userInfo->id]),null);
    }

    /**
     *  获取角色列表
     */
    public function getList($data){
        $where = [];
        !empty($data['searchContent']) && $where[] = ['username|phone','like','%'.$data['searchContent'].'%'];
        return $this->modelUser->where($where)->paginate(10);
    }

    /**
     * 新增角色信息
     */
    public function add($data){
        $data['uuid'] = uuid();
        $data['creator'] = \app\admin\middleware\Auth::$CurrentUser->id;
        $data['updater'] = \app\admin\middleware\Auth::$CurrentUser->id;
        $this->modelUser->add($data);
    }

    /**
     * 编辑信息
     */
    public function update($data){
        $data['id']===1 && exception('无操作权限');
        $data['updater'] = \app\admin\middleware\Auth::$CurrentUser->id;

        $saveData = [
            'id'=>$data['id'],
            'uuid'=>$data['uuid'],
            'username'=>$data['username'],
            'nickname'=>$data['nickname'],
            'phone'=>$data['phone'],
            'email'=>$data['email'],
            'sex'=>$data['sex']
        ];
        !empty($data['password']) && $saveData['password'] = password_hash($data['password'],1);

        $this->modelUser
            ->where('id',$data['id'])
            ->where('uuid',$data['uuid'])
            ->save($saveData);
    }

    /**
     * 删除信息
     */
    public function del($data){
        empty($data['id']) && exception('删除失败');
        empty($data['uuid']) && exception('删除失败');
        $data['id']===1 && exception('无操作权限');
        $this->modelUser
            ->where('id', $data['id'])
            ->where('uuid', $data['uuid'])
            ->find()
            ->delete();
    }
}