<?php


namespace app\admin\controller;

use app\common\config\auth\Authority;

/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2022/2/17   16:58
 */
class Auth extends ControllerBase
{
    /**
     * @OA\Get(
     *   path="/auth/getTree",
     *   summary="获取权限树",
     *   @OA\Response(
     *     response=200,
     *     description="返回权限树"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="返回权限树"
     *   )
     * )
     */
    public function getTree(){
        return result()->data(Authority::getAuthority('admin'))->toJson();
    }
}