<?php


namespace app\common\life;


use app\common\utils\UtilsLog;

class HttpRun
{
    public function handle()
    {
        UtilsLog::record('-------------------------------------------------------------------------','START');
        $this->recordLog();
    }

    /**
     * 记录url
     */
    public function recordLog(){
        $host = request()->ip() . ' ' . request()->method() . ' ' . request()->url(true);
        UtilsLog::record($host,'HOST');
        UtilsLog::record(request()->header(),'HEADER');
        UtilsLog::record(request()->param(),'PARAM');
    }
}