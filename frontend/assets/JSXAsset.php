<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class JSXAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';    
    public $js = [      
        'javascript/components/Item.jsx',
        'javascript/components/CartItem.jsx',
        'javascript/components/Menu.jsx',
        'javascript/app.jsx'
    ];
    public $jsOptions = ['type'=>'text/jsx'];
    public $depends = [
        'frontend\assets\Appasset',        
    ];
}
