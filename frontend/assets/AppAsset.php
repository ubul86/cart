<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "//use.fontawesome.com/releases/v5.6.3/css/all.css",
        'css/site.css',
    ];
    public $js = [
        "//unpkg.com/react@16/umd/react.development.js",
        "//unpkg.com/react-dom@16/umd/react-dom.development.js",
        "//unpkg.com/babel-standalone@6.26.0/babel.js",  
        "//cdnjs.cloudflare.com/ajax/libs/qs/6.6.0/qs.min.js",
        "//unpkg.com/axios/dist/axios.min.js",
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
