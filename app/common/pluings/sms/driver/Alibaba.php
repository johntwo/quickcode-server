<?php


namespace app\common\pluings\sms\driver;


use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use app\common\pluings\sms\SendResult;
use app\common\pluings\sms\SmsInterface;
use app\common\utils\UtilsLog;
use Darabonba\OpenApi\Models\Config;
use think\App;

/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/20   19:52
 */
class Alibaba implements SmsInterface
{
    protected $options = [
        // 类型
        'type'=>'Alibaba',
        // accessKeyId
        'accessKeyId'=>'',
        // accessKeySecret
        'accessKeySecret'=>'',
        // 签名
        'signName'=>''
    ];

    /**
     * 架构函数
     * @param App   $app
     * @param array $options 参数
     */
    public function __construct(App $app, array $options = [])
    {
        if (!empty($options)) {
            $this->options = array_merge($this->options, $options);
        }
    }

    /**
     * @param $params
     *
     * 样例 ['phoneNumbers'=>['17751491234','13167777777'],'templateId'=>'SMS_209196421','templateParam'=>['code'=>10]]
     *
     * @return mixed
     */
    public function send($params):SendResult
    {
        $config = new Config([
            // 您的AccessKey ID
            "accessKeyId" => $this->options['accessKeyId'],
            // 您的AccessKey Secret
            "accessKeySecret" => $this->options['accessKeySecret']
        ]);
        // 访问的域名
        $config->endpoint = "dysmsapi.aliyuncs.com";
        $client = new Dysmsapi($config);

        $sendSmsRequest = new SendSmsRequest([
            'signName'=>$this->options['signName'],
            'phoneNumbers'=>implode(",",$params['phoneNumbers']),
            'templateCode'=>$params['templateId'],
            'templateParam'=>json_encode($params['templateParam']),
        ]);
        // 复制代码运行请自行打印 API 的返回值
        $res = $client->sendSms($sendSmsRequest);

        try{
            if($res->body->code=='OK'){
                return (new SendResult())->status(true)->originalContent($res->body);
            }else{
                UtilsLog::record($res->body,"Error-Alibaba-Sms");
                exception("短信发送失败");
            }
        }catch (\Exception $e){
            UtilsLog::record($res->body,"Error-Alibaba-Sms");
            exception("短信发送失败");
        }

    }
}