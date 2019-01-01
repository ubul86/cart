<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use \yii\web\Response;

class ApiController extends Controller {

    /**
     * @var bool See details {@link \yii\web\Controller::$enableCsrfValidation}.
     */
    public $enableCsrfValidation = false;
    
    public static function allowedDomains() {
        return [
            '*', // star allows all domains              
        ];
    }
        
    public function behaviors() {
        return array_merge(parent::behaviors(),[
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    'Origin' => self::allowedDomains(),                    
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],                    
                    'Access-Control-Allow-Credentials' => null,                    
                    'Access-Control-Expose-Headers' => [],
                    'Access-Control-Request-Headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json',]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'get-api-token' => ['GET'],
                    'list-cart-items' => ['GET'],
                    'list-available-items' => ['GET'],
                    'add-item-to-cart' => ['POST'],
                    'update-cart-item' => ['GET', 'POST'],
                    'delete-item-from-cart' => ['POST'],
                    'unset-cart' => ['POST'],
                    'save-cart' => ['POST']
                ],
            ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formatParam' => '_format',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ]);
    }

    public function actions() {
        return [
            'add-item-to-cart' => actions\AddItemToCartAction::class,
            'update-cart-item' => actions\UpdateCartItemAction::class,
            'list-cart-items' => actions\ListCartItemsAction::class,
            'list-available-items' => actions\ListAvailableItemsAction::class,
            'delete-item-from-cart' => actions\DeleteItemFromCartAction::class,
            'unset-cart' => actions\UnsetCartAction::class,
            'save-cart' => actions\SaveCartAction::class,
            'get-api-token' => actions\GetApiTokenAction::class,
        ];
    }

}
