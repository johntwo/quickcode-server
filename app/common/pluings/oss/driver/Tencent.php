<?php


namespace app\common\pluings\oss\driver;


use app\common\pluings\oss\OssInterface;
use app\common\pluings\utils\Cache;
use QCloud\COSSTS\Sts;
use think\App;

/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/21   15:05
 */
class Tencent implements OssInterface
{
    use Cache;

    protected $options = [
        // 类型
        'type'=>'Tencent',
        // $secretId
        'secretId' => '',
        // $secretKey
        'secretKey' => ''
    ];

    /**
     * @var Sts sts对象
     */
    protected $sts;

    protected $cacheKey = 'ststoken';

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

        $this->sts = new Sts();
    }

    public function getStsToken($options = null)
    {
        $result = $this->getCache();
        if(!empty($result)){
            return $result;
        }

        $config = array(
            'url' => 'https://sts.tencentcloudapi.com/',
            'domain' => 'sts.tencentcloudapi.com', // 域名，非必须，默认为 sts.tencentcloudapi.com
            'proxy' => '',
            'secretId' => $this->options['secretId'], // 固定密钥,若为明文密钥，请直接以'xxx'形式填入，不要填写到getenv()函数中
            'secretKey' => $this->options['secretKey'], // 固定密钥,若为明文密钥，请直接以'xxx'形式填入，不要填写到getenv()函数中
            'bucket' => empty($options['bucket'])?$this->options['default_bucket']:$options['bucket'], // 换成你的 bucket
            'region' => $this->options['region'], // 换成 bucket 所在园区
            'durationSeconds' => $this->options['durationSeconds'], // 密钥有效期
            'allowPrefix' => empty($options['allowPrefix'])?'*':$options['allowPrefix'], // 这里改成允许的路径前缀，可以根据自己网站的用户登录态判断允许上传的具体路径，例子： a.jpg 或者 a/* 或者 * (使用通配符*存在重大安全风险, 请谨慎评估使用)
            // 密钥的权限列表。简单上传和分片需要以下的权限，其他权限列表请看 https://cloud.tencent.com/document/product/436/31923
            'allowActions' => empty($options['allowActions'])?$this->options['allowActions']:$options['allowActions']
        );
        // 获取临时密钥，计算签名
        $result = $this->sts->getTempKeys($config);
        $result['bucket'] = $config['bucket'];
        $result['region'] = $config['region'];
        $this->setCache($result,['expire'=>$result['expiredTime']-time()]);
        return $result;
    }
}