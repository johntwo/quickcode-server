<?php
namespace app\admin\controller;

use app\BaseController;
use app\common\config\result\CodeBase;
use app\common\logic\User;
use http\Exception;
use think\exception\HttpException;

class Index extends ControllerBase
{
    /**
     * @OA\Get(
     *   path="/index/index",
     *   summary="首页接口",
     *   @OA\Parameter(name="userId", in="query", @OA\Schema(type="string"), required=true, description="用户ID"),
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
    public function index()
    {
        return result()->data($this->modelUser->find(1))->toJson();
        //这是自定义返回code的，默认是0        return result()->data(['title'=>'这是测试的主页接口'])->code(CodeBase::$Fail)->toJson();
    }
}
