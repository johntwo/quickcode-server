<?php


namespace app\admin\middleware;


/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2022/2/15   17:09
 */
class ApiPermission
{
    private $module = 'admin';

    public function handle($request, \Closure $next, $params){

        $user = Auth::$CurrentUser;
        print_r($user);
        exit;
    }
}