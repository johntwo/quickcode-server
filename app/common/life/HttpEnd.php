<?php


namespace app\common\life;


use app\common\utils\UtilsLog;
use think\facade\Log;

class HttpEnd
{
    public function handle()
    {
        UtilsLog::record('-------------------------------------------------------------------------','END');
    }
}