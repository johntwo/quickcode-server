<?php


namespace app\common\utils;


use think\facade\Log;

class UtilsLog
{
    public static function record($message,$type){
        Log::record($message, $type.'-'.RID);
    }
}