<?php

namespace app\common\pluings\captcha;
use app\common\pluings\utils\Cache;
use think\facade\Config;

/**
 * Created by PhpStorm
 * USER zhangkai QQ 920062039
 * Date 2021/12/21   19:14
 */
class Driver
{
    use Cache;

    /**
     * 需要被缓存的key
     */
    protected $cacheKey;

    /**
     * 验证码配置信息
     */
    protected $config;

    /**
     * @param $type string 验证码类型
     * @param $key  string 验证码的key 如手机号码等
     * 生成验证码
     */
    public function generate($type,$key){
        $this->cacheKey = [$type,$key];
        $config = $this->getConfig($type);
        $code = $this->buildVerificationCode();
        $this->setCache($code,['expire'=>$config['expire']]);
        return $code;
    }

    /**
     * @param $type string 验证码类型
     * @param $key  string 验证码的key 如手机号码等
     * @param $code string 需要验证的验证码
     * 验证验证码是否正确
     */
    public function verify($type,$key,$code){
        $this->cacheKey = [$type,$key];
        $config = $this->getConfig($type);
        $savedCode = $this->getCache();

        if(empty($code)){
            exception("验证码已过期");
        }

        if($code != $savedCode){
            exception("验证码错误");
        }else{
            $this->setCache(null);
        }
    }

    /**
     * 获取验证码配置 ，如果不存在则报错
     */
    private function getConfig($type){
        $this->config = Config::get("captcha.type.{$type}");

        if(empty($this->config)){
            exception("验证码类型不存在");
        }

        return $this->config;
    }

    /**
     * 生成验证码
     */
    private function buildVerificationCode(){
        $length = $this->config['length'];
        $result = '';
        for($i=0;$i<$length;$i++){
            $result .= rand(0,9);
        }
        return $result;
    }
}