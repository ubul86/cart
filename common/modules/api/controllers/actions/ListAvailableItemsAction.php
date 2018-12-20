<?php

namespace common\modules\api\controllers\actions;

use Yii;
use yii\base\Action;
use yii\web\Controller;
use \yii\web\Response;
use common\helpers;
use common\modules\cart\classes\CartItem;

class ListAvailableItemsAction extends Action {

    public $controller;

    public function run() {                
        return \common\models\Item::find()->asArray()->all();
    }

}
