<?php

/**
 * 控制台主配置
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

$configs = [];
$configs['id'] = 'YiiBlog';
$configs['name'] = 'YiiBlog';
$configs['language'] = 'zh-CN';
$configs['basePath'] = dirname(__DIR__);
$configs['bootstrap'] = ['log'];

// 参数变量
$configs['params'] = require(__DIR__ . '/params.php');

// 组件
$configs['components']['db'] = require(__DIR__ . '/database.php');
$configs['components']['cache'] = ['class' => 'yii\caching\FileCache'];
$configs['components']['log'] = [
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
        ],
    ],
];

Yii::setAlias('@tests', dirname(__DIR__) . '/tests/codeception');

return $configs;


//Yii::setAlias('@tests', dirname(__DIR__) . '/tests/codeception');

//$params = require(__DIR__ . '/params.php');
//$db = require(__DIR__ . '/db.php');
//
//$config = [
//    'id' => 'basic-console',
//    'basePath' => dirname(__DIR__),
//    'bootstrap' => ['log'],
//    'controllerNamespace' => 'app\commands',
//    'components' => [
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
//        'log' => [
//            'targets' => [
//                [
//                    'class' => 'yii\log\FileTarget',
//                    'levels' => ['error', 'warning'],
//                ],
//            ],
//        ],
//        'db' => $db,
//    ],
//    'params' => $params,
//    /*
//    'controllerMap' => [
//        'fixture' => [ // Fixture generation command line.
//            'class' => 'yii\faker\FixtureController',
//        ],
//    ],
//    */
//];
//
//if (YII_ENV_DEV) {
//    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'gii';
//    $config['modules']['gii'] = [
//        'class' => 'yii\gii\Module',
//    ];
//}
//
//return $config;
