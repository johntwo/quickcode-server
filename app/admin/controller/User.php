<?php
namespace app\admin\controller;

class User extends ControllerBase
{
    /**
     * @OA\Post(
     *   path="/user/login",
     *   summary="登录接口",
     *   @OA\Parameter(name="username", in="query", @OA\Schema(type="string"), required=true, description="用户姓名"),
     *   @OA\Parameter(name="password", in="query", @OA\Schema(type="string"), required=true, description="用户密码"),
     *   @OA\Response(
     *     response=200,
     *     description="返回一段thinkphp6.0的广告"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
    public function login()
    {
        return result()->data($this->logicUser->login(request()->param()))->toJson();
    }
}
