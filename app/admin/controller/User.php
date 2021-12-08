<?php
namespace app\admin\controller;

use app\admin\middleware\Auth;
use app\admin\middleware\AuthToken;

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

    /**
     * @OA\Get(
     *   path="/user/current",
     *   summary="获取当前登录用户的信息",
     *   @OA\Response(
     *     response=200,
     *     description="返回当前登录用户信息"
     *   )
     * )
     */
    public function current(){
        return result()->data($this->logicUser->current(Auth::$CurrentUser))->toJson();
    }

    /**
     * @OA\Delete   (
     *   path="/user/logout",
     *   summary="退出登录",
     *   @OA\Response(
     *     response=200,
     *     description="返回当前登录用户信息"
     *   )
     * )
     */
    public function logout(){
        return result()->data($this->logicUser->logout(Auth::$CurrentUser))->toJson();
    }
}
