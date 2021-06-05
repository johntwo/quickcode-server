<?php
namespace app\admin\controller;

use app\BaseController;

class Index extends BaseController
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
        return "主页";
    }
}
