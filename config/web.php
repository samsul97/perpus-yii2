<?php
// $config = parse_ini_file('../htdocs/secure/perpus.ini', true);
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
  'id' => 'basic',
  'name' => 'PerpusAjj',
  'language' => 'id_ID',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log'],
  'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm'   => '@vendor/npm-asset',
  ],
  'components' => [
    'authClientCollection' => [
      'class' => '\yii\authclient\Collection',
      'clients' => [
        // 'google' => [
        //   'class'        => 'dektrium\user\clients\Google',
        //   'clientId'     => $config['1036495555463-uva97suorbbu33pjufsp2oiotdbdj112.apps.googleusercontent.com'],
        //   'clientSecret' => $config['481Rks8GJzpGsOZtx_2SP592'],
        // ],

        'google' => [
          'class' => 'yii\authclient\clients\Google',
          'clientId' => '1036495555463-uva97suorbbu33pjufsp2oiotdbdj112.apps.googleusercontent.com',
          'clientSecret' => '481Rks8GJzpGsOZtx_2SP592',
        ],
        'facebook' => [
          'class' => 'yii\authclient\clients\Facebook',
          'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
          'clientId' => '588988481517202',
          'clientSecret' => 'bca54dc57e05bf4f9086aebaeaaac6f3',
          'attributeNames' => ['name', 'email', 'first_name', 'last_name'],
        ],
      ],
    ],
    // 'modules' => [
    //   'redactor' => 'yii\redactor\RedactorModule',
    //   'class' => 'yii\redactor\RedactorModule',
    //   'uploadDir' => '@webroot/uploads',
    //   'uploadUrl' => '/perpus-yii2/uploads',
    //   'user' => [
    //     'class' => 'dektrium\user\Module',
    //     'enableUnconfirmedLogin' => TRUE,
    //     'confirmWithin' => 21600,
    //     'cost' => 12,
    //     'admins' => ['admin']
    //   ],              
    // ],
    'mail' => [
     'useFileTransport' => false,
     'class' => 'yii\swiftmailer\Mailer',
     'transport' => [
       'class' => 'Swift_SmtpTransport',
             'host' => 'smtp.gmail.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
             'username' => 'samsulaculhadi@gmail.com',
             'password' => 'sumsaloke12345',
             'port' => '587', // Port 25 is a very common port too
             'encryption' => 'tls', // It is often used, check your provider or mail server specs
           ],
         ],
         'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
          'cookieValidationKey' => 'KIDZY2IxshHmWjt03FR9I3CaICWqBJYD',
        ],
        'urlManager' => [
          'enablePrettyUrl' => true,
          'showScriptName' => false,
            /*'rules' => [
                '' => 'site/index',
                '<action>'=>'site/<action>',
              ],*/
            ],
            'cache' => [
              'class' => 'yii\caching\FileCache',
            ],
            'user' => [
              'identityClass' => 'app\models\User',
              'enableAutoLogin' => true,
            ],
            'errorHandler' => [
              'errorAction' => 'site/error',
            ],
            'mailer' => [
              'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
              'useFileTransport' => true,
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

            // 'modules' => [
            //   'redactor' => 'yii\redactor\RedactorModule',
            //   'class' => 'yii\redactor\RedactorModule',
            //   'uploadDir' => '@webroot/uploads',
            //   'uploadUrl' => '/perpus-yii2/uploads',
            //   'user' => [
            //     'class' => 'dektrium\user\Module',
            //     'enableUnconfirmedLogin' => TRUE,
            //     'confirmWithin' => 21600,
            //     'cost' => 12,
            //     'admins' => ['admin']
            //   ],              
            // ],
            'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
      ],
      'params' => $params,
    ];

    if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
      $config['bootstrap'][] = 'debug';
      $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
      ];

      $config['bootstrap'][] = 'gii';
      $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
      ];
    }

    return $config;
