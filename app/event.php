<?php
// 事件定义文件
return [
    'bind'      => [
    ],

    'listen'    => [
        'AppInit'  => [\app\common\life\AppInit::class],
        'HttpRun'  => [\app\common\life\HttpRun::class],
        'HttpEnd'  => [\app\common\life\HttpEnd::class],
        'LogLevel' => [],
        'LogWrite' => [],
    ],

    'subscribe' => [
    ],
];
