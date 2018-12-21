<?php

namespace common\modules\api\controllers\actions;

use Yii;
use yii\base\Action;
use common\helpers\ResponseHelper;
use Exception;

/**
 * Delete an item from cart by uniqueId
 * @author Gabor Sores
 */
class DeleteItemFromCartAction extends Action {
    

    public function run() {
        $uniqueId= Yii::$app->request->post('uniqueId',0);
        if ($uniqueId) {
            $cart = Yii::$app->cart;
            $cart->deleteItemFromCart($uniqueId);
        }
        else{
            throw new Exception(ResponseHelper::MESSAGE_CART_ITEM_NOT_FOUND);
        }
        return [ResponseHelper::MESSAGE_CART_DELETE_SUCCESSFULL];
    }

}
