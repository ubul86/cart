<?php

namespace common\modules\api\controllers\actions;

use Yii;
use yii\base\Action;
use yii\web\Controller;
use \yii\web\Response;
use common\helpers;
use common\modules\cart\classes\CartItem;
use common\helpers\ResponseHelper;

class DeleteItemFromCartAction extends Action {

    public $controller;

    public function run() {
        $uniqueId= \Yii::$app->request->post('uniqueId',0);
        if ($uniqueId) {
            $cart = \Yii::$app->cart;
            $cart->deleteItemFromCart($uniqueId);
        }
        else{
            throw new \Exception(ResponseHelper::MESSAGE_CART_ITEM_NOT_FOUND);
        }
        return [ResponseHelper::MESSAGE_CART_DELETE_SUCCESSFULL];
    }

}
