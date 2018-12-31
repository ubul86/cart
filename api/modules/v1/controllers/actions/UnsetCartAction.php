<?php

namespace api\modules\v1\controllers\actions;

use Yii;
use yii\base\Action;
use common\helpers\ResponseHelper;

/**
 * Unset the cart
 * @author Gabor Sores
 */
class UnsetCartAction extends Action {
    
    public function run() {        
        $cart = Yii::$app->cart;
        $cart->unsetCart();        
        return [ResponseHelper::MESSAGE_CART_UNSET_SUCCESS];
    }

}
