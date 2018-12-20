<?php

namespace common\modules\api\controllers\actions;

use Yii;
use yii\base\Action;
use yii\web\Controller;
use \yii\web\Response;
use common\helpers;
use common\modules\cart\classes\CartItem;
use Exception;
use common\helpers\ResponseHelper;

class SaveCartAction extends Action {

    public $controller;

    public function run() {

        $cart = \Yii::$app->cart;
        if (!$cart->getCount()) {
            throw new Exception(ResponseHelper::MESSAGE_CART_EMPTY_CART);
        }
        $order = new \common\modules\order\models\Order();
        
        $order->user_id = \Yii::$app->user->isGuest ? 0 : \Yii::$app->user->identity->id;
        $order->session_id = Yii::$app->session->getId();
        if ($order->validate()) {
            $transaction = $order->getDb()->beginTransaction();
            $order->save();
            foreach ($cart->getItems() as $item) {
                try {
                    $orderItem = new \common\modules\order\models\OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->item_id = $item->itemId;
                    $orderItem->item_count = $item->quantity;
                    $orderItem->save();
                } catch (\Exception $ex) {
                    $transaction->rollBack();
                    throw new Exception(ResponseHelper::MESSAGE_CART_ERROR_IN_SAVE);
                }
            }
            $transaction->commit();
            $cart->unsetCart();
        }
        else{
            throw new Exception(ResponseHelper::MESSAGE_CART_ERROR_IN_SAVE);
        }
        return [ResponseHelper::MESSAGE_CART_SAVE_SUCCESSFULL];
    }

}
