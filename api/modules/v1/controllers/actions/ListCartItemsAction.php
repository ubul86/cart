<?php

namespace api\modules\v1\controllers\actions;

use Yii;
use yii\base\Action;

/**
 * Get all cart items to list
 * @author Gabor Sores
 */
class ListCartItemsAction extends Action {

    public function run() {                
        $cart= Yii::$app->cart;        
        return $cart->getCart()->getItemsToList();
    }

}
