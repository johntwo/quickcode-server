<?php
// 应用公共文件
/**
 * 获取指定注释和注释的参数
 */
function phpAnnotateInfo($annotate,$key){
    $annotate = cleanStr($annotate);
    // 注解出现在字符串中的位置
    $keyIndex = strpos($annotate,$key);
    if($keyIndex === false){
        return null;
    }
    // 注解的长度
    $keyLength = strlen($key);
    // 整个注释的长度
    $annotateLength = strlen($annotate);

    $passLeftBrackets = false;
    $passRightBrackets = false;
    $annotates = str_split($annotate,1);

    $param = '';

    // 取出注解里面的值
    for ($i=$keyLength+$keyIndex;$i<$annotateLength;$i++){
        if(in_array($annotates[$i],['(','（'])){
            $passLeftBrackets = true;
        }
        if(in_array($annotates[$i],[')','）'])){
            $passRightBrackets = true;
        }
        if(!$passLeftBrackets || !$passRightBrackets){
            if(!in_array($annotates[$i],['(',')'])){
                $param .= $annotates[$i];
            }
        }else{
            break;
        }
    }
    // 分割参数
    $params = explode(',',$param);

    $result = [];
    foreach ($params as $item){
        $itemArr = explode('=',$item);
        $result[$itemArr[0]] = $itemArr[1];
    }
    return $result;
}
/**
 * 去除换行 空格
 */
function cleanStr($str,$other=['*']){
    $str = preg_replace("/\t/","",$str); //使用正则表达式替换内容，如：空格，换行，并将替换为空。
    $str = preg_replace("/\r\n/","",$str);
    $str = preg_replace("/\r/","",$str);
    $str = preg_replace("/\n/","",$str);
    $str = preg_replace("/ /","",$str);
    $str = preg_replace("/  /","",$str);  //匹配html中的空格
    $str = preg_replace("/\"/","",$str);
    $str = preg_replace("/\*/","",$str);
    return $str;
}

/**
 * 接口返回对象
 */
function result():\app\common\model\Result
{
    return new \app\common\model\Result();
}

/**
 * 生成uuid
 */
function uuid(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}