<?php

namespace app\swagger\controller;

class Index extends ControllerBase
{
    /**
     * swagger  模块配置信息
     */
    public function config()
    {
        return result()
            ->data($this->logicIndex->config())
            ->toJson();
    }

    /**
     * swagger  模块api信息
     */
    public function api()
    {
        return json($this->logicIndex->api($this->request->param()));
    }

    public function annotationToResources()
    {
        return $this->logicIndex->updateResourcesByAnnotation();
    }
}
