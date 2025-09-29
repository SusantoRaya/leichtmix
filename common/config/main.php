<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        // 'urlManager' => [
        //     'enablePrettyUrl' => true, // Enable pretty URLs
        //     'showScriptName' => false, // Hide the index.php file in the URL
        //     'rules' => [
        //         // Your URL rules go here
        //         '<controller>/<action>' => '<controller>/<action>',
        //         'product/<id:\d+>' => 'product/detail',
        //     ],
        // ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
    ],
];
