<?php


namespace app\common\pluings\oss;


/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/21   15:10
 */
interface OssInterface
{
    /**
     * 获取oss的sts token
     * @return mixed
     */
    public function getStsToken($options);
}