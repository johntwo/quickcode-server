<?php

namespace app\common\traits;

use think\Exception;
use think\exception\ClassNotFoundException;

trait GetBase
{
    public function __get($name)
    {
        $className = get_class($this);
        $namespaces = explode('\\', $className);
        $allowPrefix = ['logic', 'nlogic', 'model', 'nmodel'];

        $prefix = array_filter($allowPrefix, function ($item) use ($name) {
            return strpos($name, $item) === 0;
        });

        if (!empty($prefix)) {
            $prefix = array_values($prefix);
            return $this->_instanceClass($namespaces, $prefix[0], $name);
        } else {
            throw new Exception($name . ' 对象引用不正确' . '。前缀必须是：' . implode(',', $allowPrefix) . ' 之一');
        }
    }

    /**
     * @param $namespaces
     * @param $prefix
     * @param $name
     * @param bool $newInstance
     * @return object|\think\App
     * 从容器实例化对象
     */
    public function _instanceClass($namespaces, $prefix, $name)
    {
        $newInstance = $this->_isNewInstance($prefix);
        $realName = str_replace($prefix, '', $name);
        $newInstance && $prefix = substr($prefix,1);

        try {
            $classPath = '\\' . $namespaces[0] . '\\' . $namespaces[1] . '\\' . $prefix . '\\' . $realName;
            return app($classPath, [], $newInstance);
        } catch (ClassNotFoundException $e) {
            $classPath = '\\' . $namespaces[0] . '\\common\\' . $prefix . '\\' . $realName;
            return app($classPath, [], $newInstance);
        }
    }

    public function _isNewInstance($prefix)
    {
        return strpos($prefix, 'n') === 0;
    }
}