<?php

namespace app\common\config\auth;

use app\common\config\cache\CacheKey;
use Symfony\Component\Yaml\Yaml;

/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2022/2/10   20:34
 */
class Authority
{
    public static function getAuthority($module){
        empty($module) && exception('权限模块不能为空');

        $auths = cache(CacheKey::authority($module)->key());
        if(!empty($auths)){
            return $auths;
        }

        $auths = Yaml::parseFile(dirname(__FILE__).DIRECTORY_SEPARATOR.'Authority.yml');
        $auths = $auths[$module];

        if(!empty($auths)){
            cache(CacheKey::authority($module)->key(),$auths,['expire'=>3600]);
            return $auths;
        }else{
            exception('权限不存在');
        }
    }
}