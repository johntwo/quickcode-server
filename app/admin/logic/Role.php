<?php


namespace app\admin\logic;


use app\common\config\cache\CacheKey;
use app\common\config\Client;
use app\common\utils\Auth;

/**
 * Class Role
 * @package app\admin\logic
 * @property \app\common\model\Role modelRole
 */

class Role extends LogicBase
{
    /**
     *  获取角色列表
     */
    public function getList($data){
        $where = [];
        $where[] = ['client','=',Client::ADMIN];
        !empty($data['searchContent']) && $where[] = ['name','like','%'.$data['searchContent'].'%'];
        return $this->modelRole->where($where)->paginate(10);
    }

    /**
     * 新增角色信息
     */
    public function add($data){
        empty($data['name']) && exception('角色名称不能为空');
        empty($data['rules']) && exception('权限不能为空');

        $data['uuid'] = uuid();
        $data['creator'] = \app\admin\middleware\Auth::$CurrentUser->id;
        $data['updater'] = \app\admin\middleware\Auth::$CurrentUser->id;
        $data['client'] = Client::ADMIN;
        $this->modelRole->save($data);
    }

    /**
     * 编辑角色信息
     */
    public function update($data){
        empty($data['name']) && exception('角色名称不能为空');
        empty($data['rules']) && exception('权限不能为空');

        $this->modelRole
            ->where('id','=',$data['id'])
            ->where('uuid','=',$data['uuid'])
            ->find()
            ->save([
                'name'=>$data['name'],
                'rules'=>$data['rules'],
                'updater'=>\app\admin\middleware\Auth::$CurrentUser->id
            ]);
        cache(CacheKey::role()->key($data['id']),null);
    }

    /**
     * 删除角色信息
     */
    public function del($data){
        empty($data['id']) && exception('删除失败');
        empty($data['uuid']) && exception('删除失败');
        $this->modelRole
            ->where('id',$data['id'])
            ->where('uuid',$data['uuid'])
            ->find()
            ->delete();
    }

    /**
     *  获取角色列表
     */
    public function getOption($data){
        $where = [];
        $where[] = ['client','=',Client::ADMIN];
        !empty($data['searchContent']) && $where[] = ['name','like','%'.$data['searchContent'].'%'];
        return $this->modelRole->field(['id','name'])->where($where)->select();
    }
}