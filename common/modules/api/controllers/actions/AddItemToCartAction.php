<?php

namespace common\modules\api\controllers\actions;

use yii\base\Action;
use common\modules\cart\classes\CartItem;
use Exception;
use common\helpers\ResponseHelper;

class AddItemToCartAction extends Action {

    public $controller;

    public function run() {
        $itemId= \Yii::$app->request->post('item_id',0);
        $quantity= \Yii::$app->request->post('quantity',0);
        if(!$itemId || !$quantity){
            throw new Exception(ResponseHelper::MESSAGE_CART_ERROR_IN_SAVE);
        }
        $model= \common\models\Item::findOne($itemId);
        if(!$model){
            throw new Exception(ResponseHelper::MESSAGE_ITEM_NOT_FOUND);
        }
        $cart= \Yii::$app->cart;
        $cartItem=$cart->getItemByItemId($itemId);
        if(!$cartItem){
            $cartItem=new CartItem($itemId,$quantity);
            $cart->addItemToCart($cartItem);
        }
        else{
            $quantity=$cartItem->getQuantity()+$quantity;
            $cart->updateItemFromCart($cartItem->getUniqueId(),$quantity); 
        }
        return ["item" => $cartItem->getContent()];
    }

}
