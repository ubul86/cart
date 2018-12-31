<?php

namespace api\modules\v1\controllers\actions;

use yii\base\Action;
use Yii;

/**
 * Add a new item to the cart, or update the existing item quantity
 *
 * @author Gabor Sores
 */
class GetApiTokenAction extends Action {

    public function run() {
        return [\Yii::$app->security->generateRandomString()];
    }

}
