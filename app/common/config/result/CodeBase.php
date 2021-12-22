<?php
// +---------------------------------------------------------------------+
// | OneBase    | [ WE CAN DO IT JUST THINK ]                            |
// +---------------------------------------------------------------------+
// | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )           |
// +---------------------------------------------------------------------+
// | Author     | Bigotry <3162875@qq.com>                               |
// +---------------------------------------------------------------------+
// | Repository | https://gitee.com/Bigotry/OneBase                      |
// +---------------------------------------------------------------------+

namespace app\common\config\result;

class CodeBase
{
    public static $Success             = ['code' => 0,   'message' => '操作成功'];
    public static $Fail             = ['code' => -1,   'message' => '操作失败'];
    public static $UnLogin            = ['code' => 10000,   'message' => '当前未登录'];
}
