<?php

$params = array_merge(
        require (__DIR__ . '/../../common/config/params.php'), require (__DIR__ . '/../../common/config/params-local.php'), require (__DIR__ . '/params.php'), require (__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'frontend\models\Customer',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
// this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                    [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '<controller>/<action>' => '<controller>/<action>',
                'offer-buy-form/<id:\d+>' => 'offer-buy-form/view',
                'offer-status-update/<id:\d+>/<status:\d+>' => 'offers-status-update/view',
            ],
//'rules' => [
//[
//'class' => 'common\components\UrlRule',
//],
//],
        ],
        'config' => [
            'class' => 'common\components\configdb\ConfigInDB',
        ],
        'view' => [
            'theme' =>
                [
                'class' => 'common\components\thememanager\ThemeManager',
                //'current'   =>  'site',
                'db' => true,
                'themes' =>
                    [
                    'site' =>
                        [
                        'baseUrl' => '@frontend/themes/site',
                        'pathMap' =>
                            [
                            '@app/views' => '@frontend/themes/site',
                            '@app/views/layouts' => '@frontend/themes/site/layouts',
                        ],
                    //'defaultLayout'             =>  '//inner',
                    ],
                    'siteeee' =>
                        [
                        'basePath' => '@frontend/themes/siteeee',
                        'baseUrl' => '@frontend/themes/siteeee',
                        'pathMap' =>
                            [
                            '@app/views' => '@frontend/themes/siteeee',
                            '@app/views/layouts' => '@frontend/themes/siteeee/layouts',
                        ],
                    //'defaultLayout'             =>  '//inner',
                    ],
                ],
            ],
        ],
    ], 'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'params' => $params,
];
