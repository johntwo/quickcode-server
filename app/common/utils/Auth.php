<?php

namespace app\common\utils;

class Auth
{
    /**
     * 生成token
     */
    public static function buildToken($id){
        $uuid = uuid();
        return ['uuid'=>$uuid,'id'=>$id,'token'=>base64_encode($id.':'.$uuid)];
    }
}