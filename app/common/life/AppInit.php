<?php


namespace app\common\life;


class AppInit
{
    /**
     * 每一次请求都会执行该方法
     */
    public function handle()
    {
        // 初始化贯穿请求的 唯一 id
        $this->initRid();
    }

    /**
     * 生成该次请求的唯一编码
     */
    public function initRid()
    {
        define('RID', uuid());
    }
}