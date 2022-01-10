<?php


namespace app\common\pluings\officialaccount;


/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/21   15:10
 */
interface OfficialAccountInterface
{
    /**
     * 发送模板消息
     */
    public function sendTemplateMessage($params);
}