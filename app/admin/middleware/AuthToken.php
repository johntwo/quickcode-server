<?php

namespace app\admin\middleware;

use app\common\config\cache\CacheKey;

class AuthToken
{
    public function handle($request, \Closure $next)
    {
        $token = $request->header('token');
        if(empty($token)){
            \exception("当前未登录，请登录");
        }else{
            $decodeToken = base64_decode($token);
            $decodeToken = explode(":",$decodeToken);
            $userInfo = cache(CacheKey::loginAdminToken()->key([$decodeToken[0]]));
            if(empty($userInfo)){
                \exception("当前未登录，请登录");
            }else{
                if(!($userInfo->token_uuid == $decodeToken[1] && $userInfo->id == $decodeToken[0])){
                    \exception("当前未登录，请登录");
                }
            }
        }

        return $next($request);
    }
}