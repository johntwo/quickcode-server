<?php

namespace app\admin\controller;

class Oss extends ControllerBase
{
    /**
     * @OA\Get(
     *   path="/oss/getOssToken",
     *   summary="获取oss token",
     *   @OA\Response(
     *     response=200,
     *     description="返回OssToken"
     *   )
     * )
     */
    public function getOssToken()
    {
        return result()->data(app()->oss->getStsToken())->toJson();
    }
}
