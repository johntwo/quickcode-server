<?php

namespace app\common\pluings\applet\driver;

use app\common\pluings\applet\AppletInterface;
use app\common\pluings\utils\EasyWechatLog;
use EasyWeChat\Factory;
use think\App;

/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/30   14:57
 */
class Wechat implements AppletInterface
{

    protected $options = [
        // 类型
        'type'=>'Wechat',
        // $secretId
        'appId' => '',
        // $secretKey
        'appSecret' => ''
    ];

    protected $miniProgram;

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

        $this->miniProgram = Factory::miniProgram($config);
        $this->miniProgram->rebind('logger',new EasyWechatLog());
    }

    /**
     * @param string $code
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * 获取用户登录信息
     */
    public function getUserInfo($code)
    {
        $result = $this->miniProgram->auth->session($code);

        empty($result['openid']) && exception("用户信息获取失败");

        return $result;
    }
}