<?php


namespace app\admin\middleware;


use app\common\model\User;

/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2022/2/15   17:09
 */
class ApiPermission
{
    public function handle($request, \Closure $next, $params){

        $user = app(User::class,[]);
        $user->id = Auth::$CurrentUser->id;
        $user->roles = Auth::$CurrentUser->roles;
        $authorities = $user->getAuthoritiesAttr();

        if(in_array('admin', $authorities)){
            return $next($request);
        }else{
            $hadAuthorities = array_intersect($authorities,$params);
            if(count($hadAuthorities) <= 0){
                exception("无访问权限");
            }

            return $next($request);
        }
    }
}