<?php

namespace common\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use \yii\web\Response;

class ApiController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [                    
                    'list-cart-items' => ['GET'],
                    'list-available-items' => ['GET'],
                    'add-item-to-cart' => ['POST'],
                    'update-cart-item' => ['GET', 'POST'],
                    'delete-item-from-cart' => ['DELETE'],
                    'unset-cart' => ['DELETE'],
                    'save-cart' => ["POST"]
                ],
            ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formatParam' => '_format',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
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
        ];
    }

}
