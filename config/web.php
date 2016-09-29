<?php

/**
 * 全局配置
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

$configs = [];
$configs['id'] = 'Y2OS';
$configs['name'] = 'YiiBlog';
$configs['language'] = 'zh-CN';
$configs['basePath'] = dirname(__DIR__);
$configs['bootstrap'] = ['log'];

// 参数变量
$configs['params'] = require(__DIR__ . '/params.php');

// 模块
$configs['modules']['admini'] = ['class' => 'app\modules\admini\Module'];

// 组件
$configs['components']['request'] = ['cookieValidationKey' => 'hiBKoy9KHgq32TLHD6VKatPabzBaPN0Y'];
$configs['components']['cache'] = ['class' => 'yii\caching\FileCache'];
$configs['components']['errorHandler'] = ['errorAction' => 'site/error'];
$configs['components']['db'] = require(__DIR__ . '/database.php');
$configs['components']['mailer'] = ['class' => 'yii\swiftmailer\Mailer', 'useFileTransport' => true];
$configs['components']['urlManager'] = ['enablePrettyUrl' => false, 'showScriptName' => true, 'rules' => []];
$configs['components']['log'] = [
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
        ],
    ],
];

$configs['components']['user'] = [
    'identityClass' => 'app\models\User',
    'enableAutoLogin' => true,
    'loginUrl' => ['/admini/signin'],
    'identityCookie' => ['name' => '__user_identity'],
    'idParam' => '__user'
];

// 开发模式
if (YII_ENV_DEV) {
    $configs['bootstrap'][] = 'debug';
    $configs['modules']['debug'] = ['class' => 'yii\debug\Module'];
    $configs['bootstrap'][] = 'gii';
    $configs['modules']['gii'] = ['class' => 'yii\gii\Module'];
}

return $configs;
