<?php

namespace api\modules\v1;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'api\modules\v1\controllers';

    public function beforeAction($action) {
        parent::beforeAction($action);
        $token=\Yii::$app->request->get('token',null);
        if($token){
            \Yii::$app->session->setId($token);
        }
        return true;
    }
    
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
