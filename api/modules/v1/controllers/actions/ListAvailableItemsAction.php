<?php

namespace api\modules\v1\controllers\actions;

use yii\base\Action;
use common\models\Item;

/**
 * List the existing items
 *
 * @author Gabor Sores
 */
class ListAvailableItemsAction extends Action {

    public function run() {              
        // TODO: paginate items, not load everything at once        
        return Item::find()->asArray()->all();
    }

}
