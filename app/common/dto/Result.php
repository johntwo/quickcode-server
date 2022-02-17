<?php


namespace app\common\dto;


use app\common\config\result\CodeBase;
use think\response\Json;
use function json;
use const RID;

/**
 * Class Result
 * @package app\common\model
 * json返回对象
 */
class Result
{
    protected $code;
    protected $data;
    protected $statusCode;

    public function __construct()
    {
        $this->code = CodeBase::$Success;
        $this->statusCode = 200;
    }

    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    public function code(array $code){
        $this->code = $code;
        return $this;
    }

    public function statusCode(int $code){
        $this->statusCode = $code;
        return $this;
    }

    public function toJson():Json
    {
        $result = [
            'code'=>$this->code['code'],
            'data'=>$this->data,
            'message'=>$this->code['message'],
            'rid'=>RID
        ];

        return json($result,$this->statusCode);
    }
}