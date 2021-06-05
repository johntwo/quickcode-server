<?php
namespace app\swagger\controller;

class Index extends ControllerBase
{
    /**
     * swagger  模块配置信息
     */
    public function config(){
        return json($this->logicIndex->config());
    }

    /**
     * swagger  模块api信息
     */
    public function api(){
        return json($this->logicIndex->api($this->request->param()));
    }

    public function annotationToResources(){
        return $this->logicIndex->updateResourcesByAnnotation();
    }
}
