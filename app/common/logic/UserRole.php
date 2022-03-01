<?php


namespace app\common\logic;



use think\facade\Db;

class UserRole extends LogicBase
{
    /**
     * 保存角色信息
     */
    public function save($data){
        empty($data['client']) && exception('客户端类型不能为空');
        empty($data['uid']) && exception('用户id不能为空');

        $where = [
            'client'=>$data['client'],
            'uid'=>$data['uid'],
            'client_id'=>empty($data['client_id'])?0:$data['client_id']
        ];
        $userRole = $this->modelUserRole->where($where)->find();

        if(!empty($userRole)){
            $data['id'] = $userRole['id'];
        }
        $userRole->save($data);
    }
}