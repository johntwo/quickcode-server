<?php


namespace app\common\life;


/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2022/2/22   20:53
 */
trait InitVar
{
    /**
     * 初始化业务变量
     */
    public function initLogicVar(){
        define('PARAMS',request()->param());
    }
}