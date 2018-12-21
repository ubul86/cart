<?php

namespace common\modules\api\controllers\actions;

use yii\base\Action;
use common\modules\cart\classes\CartItem;
use Exception;
use common\helpers\ResponseHelper;
use Yii;

/**
 * Add a new item to the cart, or update the existing item quantity
 *
 * @author Gabor Sores
 */
class AddItemToCartAction extends Action {

    public function run() {
        $itemId= Yii::$app->request->post('item_id',0);
        $quantity= Yii::$app->request->post('quantity',0);
        if(!$itemId || !$quantity){
            throw new Exception(ResponseHelper::MESSAGE_CART_ERROR_IN_SAVE);
        }
        $model= \common\models\Item::findOne($itemId);
        if(!$model){
            throw new Exception(ResponseHelper::MESSAGE_ITEM_NOT_FOUND);
        }
        $cart= Yii::$app->cart;
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
