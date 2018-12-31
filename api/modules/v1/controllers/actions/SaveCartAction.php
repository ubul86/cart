<?php

namespace api\modules\v1\controllers\actions;

use Yii;
use yii\base\Action;
use Exception;
use common\helpers\ResponseHelper;
use common\modules\order\models\Order;

/**
 * Save contain of the cart and unset session
 * @author Gabor Sores
 */
class SaveCartAction extends Action {

    public function run() {
        $cart = Yii::$app->cart;
        if (!$cart->getCount()) {
            throw new Exception(ResponseHelper::MESSAGE_CART_EMPTY_CART);
        }
        $order = new Order();
        
        $order->user_id = Yii::$app->user->isGuest ? 0 : Yii::$app->user->identity->id;
        $order->session_id = Yii::$app->session->getId();
        if($order->saveOrder($cart)){
            $cart->unsetCart();
        }
        else{          
            throw new Exception(ResponseHelper::MESSAGE_CART_ERROR_IN_SAVE);
        }
        return [ResponseHelper::MESSAGE_CART_SAVE_SUCCESSFULL];
    }

    
    
}
