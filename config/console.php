<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

    $params = file_exists ( __DIR__ . '/params-local.php') ? require(__DIR__ . '/params-local.php') : require(__DIR__ . '/params.php');
    $db = file_exists ( __DIR__ . '/db-local.php') ? require(__DIR__ . '/db-local.php') : require(__DIR__ . '/db.php');
return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];
