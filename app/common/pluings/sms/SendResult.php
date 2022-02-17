<?php


namespace app\common\pluings\sms;


/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/20   17:36
 */
class SendResult
{
    /**
     * @var boolean 发送状态
     */
    public $status;

    /**
     * @var object 发送接口返回的原始数据
     */
    public $originalContent;

    public function status($status){
        $this->status = $status;
        return $this;
    }

    public function originalContent($originalContent){
        $this->originalContent = $originalContent;
        return $this;
    }
}