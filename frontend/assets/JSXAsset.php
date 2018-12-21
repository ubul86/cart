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
        'javascript/components/SnackBar.jsx',
        'javascript/components/UnsetCart.jsx',
        'javascript/components/SaveCart.jsx',
        'javascript/components/Items.jsx',
        'javascript/components/Item.jsx',
        'javascript/components/Cart.jsx',
        'javascript/components/CartItem.jsx',
        'javascript/components/Main.jsx',
        'javascript/app.jsx'
    ];
    public $jsOptions = ['type'=>'text/jsx'];
    public $depends = [
        'frontend\assets\Appasset',        
    ];
}
