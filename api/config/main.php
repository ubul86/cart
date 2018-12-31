<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\v1\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'cart' => [
            'class' => \api\component\CartComponent::class,
        ],
        'request' => [
            'csrfParam' => '_csrf-api',
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $exception = \Yii::$app->errorHandler->exception;
                /* @var \yii\web\Response $response */
                $response = $event->sender;

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
            },
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            'sessionTable' => 'cart_session', // session table name. Defaults to 'session'.            
            'timeout' => 3600,      
            'readCallback' => function($session){               
                $token = Yii::$app->request->get("token", null);
                return [
                    'id' => $token,
                ];
            },
        ],
        'user' => [
            'class' => 'yii\web\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'authTimeout' => 60 * 30,
            'identityClass' => 'api\models\User',
            'identityCookie' => [
                'name' => '_panelUser',
            ]
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
                '<controller:(v1)>/add-item-to-cart' => '<controller>/api/add-item-to-cart',
                '<controller:(v1)>/delete-item-from-cart' => '<controller>/api/delete-item-from-cart',
                '<controller:(v1)>/update-cart-item' => '<controller>/api/update-cart-item',
                '<controller:(v1)>/list-cart-items' => '<controller>/api/list-cart-items',
                '<controller:(v1)>/list-available-items' => '<controller>/api/list-available-items',
                '<controller:(v1)>/unset-cart' => '<controller>/api/unset-cart',
                '<controller:(v1)>/save-cart' => '<controller>/api/save-cart',
                '<controller:(v1)>/get-api-token' => '<controller>/api/get-api-token',
            ]
        ],
    ],
    'params' => $params,
];
