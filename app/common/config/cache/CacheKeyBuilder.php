<?php


namespace app\common\config\cache;


class CacheKeyBuilder
{
    protected $keys;

    public function __construct(array $prefixs)
    {
        $this->keys = $prefixs;
    }

    public function key($appendKeys = null){
        if(!empty($appendKeys)){
            if(is_array($appendKeys)){
                $this->keys = array_merge($this->keys,$appendKeys);
            }else{
                array_push($this->keys,$appendKeys);
            }
        }

        return implode(":",$this->keys);
    }
}