<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
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
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $exception = \Yii::$app->errorHandler->exception;
                /* @var \yii\web\Response $response */
                $response = $event->sender;
                if (Yii::$app->controller->id == "api") {
                    if (!$exception) {
                        $response->data = (new \common\helpers\ResponseHelper())->setResponse(\common\helpers\ResponseHelper::RESPONSE_SUCCESS, $response->data)->output();
                    } else {
                        if (is_a($exception, Exception::class)) {
                            $response->data = (new \common\helpers\ResponseHelper())->setResponse($exception->getCode(), $exception->getMessage())->output();
                        }
                        if ($response->isServerError && is_a($exception, \yii\db\IntegrityException::class)) {
                            // here you can define custom message to show
                            $response->data = 'Integrity exception: ' . $exception->getMessage();
                        }
                    }
                }
            },
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'enableSession' => true,
            'identityCookie' => ['name' => 'user_phpsess', 'httpOnly' => true],
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
            'rules' => [
                '<controller:(api)>/add-item-to-cart' => '<controller>/api/add-item-to-cart',
                '<controller:(api)>/delete-item-from-cart' => '<controller>/api/delete-item-from-cart',
                '<controller:(api)>/update-cart-item' => '<controller>/api/update-cart-item',
                '<controller:(api)>/list-cart-items' => '<controller>/api/list-cart-items',
                '<controller:(api)>/list-available-items' => '<controller>/api/list-available-items',
                '<controller:(api)>/unset-cart' => '<controller>/api/unset-cart',
                '<controller:(api)>/save-cart' => '<controller>/api/save-cart',
//                '<controller:(post|comment)>/<id:\d+>/<action:(update|delete)>' => '<controller>/<action>',
//                '<controller:(post|comment)>/<id:\d+>' => '<controller>/view',
//                '<controller:(post|comment)>s' => '<controller>/index',
            ]
        ],
    ],
    'params' => $params,
];
