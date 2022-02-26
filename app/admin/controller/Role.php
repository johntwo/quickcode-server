<?php


namespace app\admin\controller;

/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2022/2/17   16:58
 */
class Role extends ControllerBase
{

    /**
     * @OA\Get(
     *   path="/role/getList",
     *   summary="获取角色列表",
     *   @OA\Response(
     *     response=200,
     *     description="返回角色列表"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="返回角色列表"
     *   )
     * )
     */
    public function getList(){
        return result()->data($this->logicRole->getList(request()->param()))->toJson();
    }

    /**
     * @OA\Post(
     *   path="/role/add",
     *   summary="新增角色信息",
     *   @OA\Response(
     *     response=200,
     *     description=""
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description=""
     *   )
     * )
     */
    public function add(){
        return result()->data($this->logicRole->add(request()->param()))->toJson();
    }

    /**
     * @OA\Patch(
     *   path="/role/update",
     *   summary="更新角色信息",
     *   @OA\Response(
     *     response=200,
     *     description=""
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description=""
     *   )
     * )
     */
    public function update(){
        return result()->data($this->logicRole->update(request()->param()))->toJson();
    }

    /**
     * @OA\Delete (
     *   path="/role/del",
     *   summary="删除角色信息",
     *   @OA\Response(
     *     response=200,
     *     description=""
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description=""
     *   )
     * )
     */
    public function del(){
        return result()->data($this->logicRole->del(request()->param()))->toJson();
    }

    /**
     * @OA\Get(
     *   path="/role/getOption",
     *   summary="获取角色列表选项",
     *   @OA\Response(
     *     response=200,
     *     description="获取角色列表选项"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="获取角色列表选项"
     *   )
     * )
     */
    public function getOption(){
        return result()->data($this->logicRole->getOption(request()->param()))->toJson();
    }
}