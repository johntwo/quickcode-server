<?php


namespace app\common\config\cache;

/**
 * Class CacheKey
 * 缓存key的配置
 * key为数组  会拼接成字符串  例：['admin','user']    对应的key为 admin:user
 */
class CacheKey
{
    /**
     * @return CacheKeyBuilder
     * token构造器
     */
    public static function token(): CacheKeyBuilder
    {
        return new CacheKeyBuilder(['admin', 'user']);
    }

}