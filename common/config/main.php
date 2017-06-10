<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru',
    'sourceLanguage' => 'ru',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => Yii::getAlias('@common') . '/cache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'i18n' => [
            'translations' => [
                'common*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/i18n/',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'common' => 'common.php',
                    ],
                ],
                'messages*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/i18n/',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'messages' => 'messages.php',
                    ],
                ],
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/i18n/',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'frontend' => 'common.php',
                        'frontend/messages' => 'messages.php',
                    ],
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/i18n/',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'backend' => 'common.php',
                    ],
                ],
            ],
        ],
        'formatter' => [
            'dateFormat' => 'd-M-Y',
            'datetimeFormat' => 'd-M-Y H:i:s',
            'timeFormat' => 'H:i:s',
            'locale' => 'ru', //your language locale
        //'defaultTimeZone' => 'Europe/Berlin', // time zone
        ],
    ],
];
