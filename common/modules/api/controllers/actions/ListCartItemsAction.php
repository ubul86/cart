<?php

namespace common\modules\api\controllers\actions;

use Yii;
use yii\base\Action;
use yii\web\Controller;
use \yii\web\Response;
use common\helpers;
use common\modules\cart\classes\CartItem;

class ListCartItemsAction extends Action {

    public $controller;

    public function run() {                
        $cart= \Yii::$app->cart;        
        return $cart->getCart()->getItemsToList();
    }

}
