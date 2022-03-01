<?php


namespace app\common\config\cache;

use think\Cache;

/**
 * Class CacheKey
 * 缓存key的配置
 * key为数组  会拼接成字符串  例：['admin','user']    对应的key为 admin:user
 */
class CacheKey
{
    /**
     * @return CacheKeyBuilder
     * 后台登录 token key
     */
    public static function loginAdminToken(): CacheKeyBuilder
    {
        return new CacheKeyBuilder(['Login','Token', 'Admin']);
    }

    /**
     * @return CacheKeyBuilder
     * app登录 token key
     */
    public static function loginAppToken(): CacheKeyBuilder
    {
        return new CacheKeyBuilder(['Login','Token', 'App']);
    }

    /**
     * @param $module
     * @return CacheKeyBuilder
     * 接口权限
     */
    public static function authority($module): CacheKeyBuilder
    {
        return new CacheKeyBuilder(['Authority',$module]);
    }

    public static function role():CacheKeyBuilder
    {
        return new CacheKeyBuilder(['Role']);
    }

}