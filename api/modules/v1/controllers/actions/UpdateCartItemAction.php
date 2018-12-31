<?php

namespace api\modules\v1\controllers\actions;

use Yii;
use yii\base\Action;
use Exception;
use common\helpers\ResponseHelper;

/**
 * Update an existing cart item quantity
 * TODO: Develop usage to frontend
 * @author Gabor Sores
 */
class UpdateCartItemAction extends Action {

    public function run() {
        $itemId= Yii::$app->request->get('item_id',0);
        $quantity= Yii::$app->request->get('quantity',0);
        if(!$itemId || !$quantity){
            throw new Exception(ResponseHelper::MESSAGE_CART_ERROR_IN_SAVE);
        }        
        try{
            $cart= Yii::$app->cart;
            $cart->updateItemFromCart($itemId,$quantity);            
            $cartItem=$cart->getItemByUniqueId($itemId);            
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }        
        
        return ["item" => $cartItem->getContent()];
    }

}
