<?php


namespace app\common\pluings\officialaccount\driver;


use app\common\pluings\officialaccount\OfficialAccountInterface;
use app\common\pluings\utils\Cache;
use app\common\pluings\utils\EasyWechatLog;
use app\common\utils\UtilsLog;
use EasyWeChat\Factory;
use think\App;

/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/21   15:05
 */
class Wechat implements OfficialAccountInterface
{
    use Cache;

    protected $options = [
        // 类型
        'type'=>'Wechat'
    ];

    /**
     * @var \EasyWeChat\OfficialAccount\Application
     */
    protected $officialAccount;

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
        $config = [
            'app_id' => $this->options['appId'],
            'secret' => $this->options['appSecret'],

            // 下面为可选项
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',
        ];
        UtilsLog::record(config('officialaccount'),"测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试");
        $this->officialAccount = Factory::officialAccount($config);
        $this->officialAccount->rebind('logger',new EasyWechatLog());
    }


    /**
     * 'touser' => 'user-openid',
     *'template_id' => 'template-id',
     *'url' => 'https://easywechat.org',
     *'miniprogram' => [
     *'appid' => 'xxxxxxx',
     *'pagepath' => 'pages/xxx',
     *],
     *'data' => [
     *'key1' => 'VALUE',
     *'key2' => 'VALUE2',
     *...
     *]
     */
    public function sendTemplateMessage($params)
    {
        $this->validSendTemplateMessage($params);
        return $this->officialAccount->template_message->send($params);
    }

    /**
     * 验证参数是否足够
     */
    public function validSendTemplateMessage($params){
        empty($params['touser']) && exception("发送人信息不能为空");
        empty($params['template_id']) && exception("模板信息不能为空");
        empty($params['data']) && exception("模板内容不能为空");
    }

    public function getOfficialAccount()
    {
        empty($this->officialAccount) && exception('公众号不存在');
        return $this->officialAccount;
    }
}