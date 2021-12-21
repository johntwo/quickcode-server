<?php

namespace app\common\pluings\utils;
/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/21   15:40
 */
trait Cache
{
    /**
     * 获取cacheKey
     */
    public function getCacheKey(){
        $class = get_class($this);
        $cacheKeys = explode("\\",$class);
        array_push($cacheKeys,$this->cacheKey);

        return implode(':',$cacheKeys);
    }

    /**
     * 获取缓存内容
     */
    public function getCache(){
        $cacheKey = $this->getCacheKey();
        return cache($cacheKey);
    }

    /**
     * 设置缓存内容
     */
    public function setCache($var,$options=null){
        $cacheKey = $this->getCacheKey();
        cache($cacheKey,$var,$options);
    }
}