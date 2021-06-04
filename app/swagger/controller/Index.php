<?php
namespace app\swagger\controller;

use app\BaseController;

class Index extends BaseController
{
    /**
     * swagger  模块配置信息
     */
    public function config(){
        return json((new \app\swagger\logic\Index())->config());
    }

    /**
     * swagger  模块api信息
     */
    public function api(){
        return json((new \app\swagger\logic\Index())->api($this->request->param()));
    }

    public function annotationToResources(){
        return (new \app\swagger\logic\Index())->updateResourcesByAnnotation();
    }
}
