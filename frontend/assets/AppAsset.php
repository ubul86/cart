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
        "https://use.fontawesome.com/releases/v5.6.3/css/all.css",
        'css/site.css',
    ];
    public $js = [
        "https://unpkg.com/react@16/umd/react.development.js",
        "https://unpkg.com/react-dom@16/umd/react-dom.development.js",
        "https://unpkg.com/babel-standalone@6.26.0/babel.js",        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
