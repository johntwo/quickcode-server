<?php

namespace app\admin\middleware;

use app\common\config\cache\CacheKey;
use app\common\config\result\CodeBase;

class AuthToken
{
    public function handle($request, \Closure $next)
    {
        $token = $request->header('token');
        if(empty($token)){
            \exception(CodeBase::$UnLogin['message'],CodeBase::$UnLogin['code']);
        }else{
            $decodeToken = base64_decode($token);
            $decodeToken = explode(":",$decodeToken);
            $userInfo = cache(CacheKey::loginAdminToken()->key([$decodeToken[0]]));
            if(empty($userInfo)){
                \exception(CodeBase::$UnLogin['message'],CodeBase::$UnLogin['code']);
            }else{
                if(!($userInfo->token_uuid == $decodeToken[1] && $userInfo->id == $decodeToken[0])){
                    \exception(CodeBase::$UnLogin['message'],CodeBase::$UnLogin['code']);
                }
            }
            Auth::$CurrentUser = $userInfo;
        }

        return $next($request);
    }
}