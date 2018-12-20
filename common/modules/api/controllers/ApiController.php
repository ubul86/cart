<?php

namespace common\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;

class ApiController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [                    
                    'list' => ['GET'],
                    'list-available-items' => ['GET'],
                    'add-item' => ['POST'],
                    'update' => ['GET', 'PUT', 'POST'],
                    'delete-item' => ['POST'],
                    'unset-cart' => ['GET'],
                    'save-cart' => ["GET"]
                ],
            ],
            'contentNegotiator' => [
                'class' => \yii\filters\ContentNegotiator::className(),
                'formatParam' => '_format',
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
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
