<?php
namespace app\swagger\logic;

use OpenApi\Generator;

class Index extends LogicBase
{
    /**
     * swagger  模块配置信息
     */
    public function config(){
        $apiModels = $this->getApiModule();
        $temp = [
            'name'=>'%s模块',
            'url'=>'/swagger/index/api?module=%s',
            'swaggerVersion'=>'1.0',
            'location'=>'/swagger/index/api?module=%s'
        ];

        $result = [];
        foreach ($apiModels as $item){
            array_push($result,[
                'name'=>sprintf($temp['name'],$item),
                'url'=>sprintf($temp['url'],$item),
                'swaggerVersion'=>$temp['swaggerVersion'],
                'location'=>sprintf($temp['location'],$item)
            ]);
        }

        return ['urls'=>$result];
    }

    /**
     * 获取apimodel
     */
    public function getApiModule(){
        $dir = dirname(dirname(__DIR__));
        $files = scandir($dir);
        $dirNames = [];
        foreach ($files as $item){
            is_dir($dir.'/'.$item) && !in_array($item,['.','..']) && array_push($dirNames,$item);
        }
        $apiModels = array_diff($dirNames,array_merge(config('app.deny_app_list'),['swagger']));
        return $apiModels;
    }

    /**
     * 获取api接口信息
     */
    public function api($params){
        $openapi = Generator::scan([$this->getModulePath($params['module'],'controller')]);

        $result = json_decode($openapi->toJson());

        return $result;
    }

    /**
     * 获取模块的controller路径
     */
    public function getModulePath($module='',$folderName=''){
        return dirname(dirname(__DIR__)) . '/'.$module.'/'.$folderName;
    }

    /**
     * swagger 转 route
     */
    public function swaggerToRoute($swagger)
    {
        $server = $swagger['servers'][0]['url'];
        $paths = $swagger['paths'];

        $result = [];

        foreach ($paths as $path => $value) {
            foreach ($value as $method=>$params){
                $controllerInfo = $this->getSwaggerControlAndFun($params['operationId']);
                $controllerInfo['request_method'] = $method;
                $controllerInfo['path'] = $server.$path;
                $controllerInfo['root_path'] = $server;
                array_push($result,$this->buildThinkRoute($controllerInfo));
            }
        }

        return $result;
    }

    /**
     * 获取swagger中的控制器和方法
     */
    public function getSwaggerControlAndFun($operationId){
        $pattern = '/\w*::\w*/';
        $matchResult = [];
        preg_match($pattern,$operationId,$matchResult);

        $result = null;

        if(!empty($matchResult)){
            $result = [
                'controller'=>explode('::',$matchResult[0])[0],
                'method'=>explode('::',$matchResult[0])[1]
            ];
        }
        return $result;
    }

    /**
     * 根据swagger信息生成  Route信息
     */
    public function buildThinkRoute($routeInfo){
        $result = 'Route::%s(\'%s$\', \'%s\');';

        $result = sprintf($result,
            $routeInfo['request_method'],
            $routeInfo['controller'].'/'.$routeInfo['method'],
            $routeInfo['root_path'].'/'.$routeInfo['controller'].'/'.$routeInfo['method']);

        return $result;
    }

    /**
     * 根据swagger+自定义注解，更新相关资源
     */
    public function updateResourcesByAnnotation(){
        // 更新静态的路由文件 各个模块下面的route文件
        $this->updateRouteByAnnotation();
        // 更新到接口到 mysql
    }

    /**
     * 根据swagger+自定义注解，更新route.php
     */
    public function updateRouteByAnnotation(){
        $data = file_get_contents(dirname(__DIR__).'/temp/app.php');


        $apiModules = $this->getApiModule();

        foreach ($apiModules as $module){
            $openapi = Generator::scan([$this->getModulePath($module,'controller')]);
            $result = json_decode($openapi->toJson(),true);
            $return = $this->swaggerToRoute($result);
            foreach ($return as $item ){
                $data .= $item."\r\n";
            }
            $path = $this->getModulePath($module,'route').'/app.php';
            if(!file_exists(dirname($path))){
                mkdir(dirname($path),0777,true);
            }
            file_put_contents($path,$data);
        }
    }

}
