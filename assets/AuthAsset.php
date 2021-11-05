<?php


namespace app\assets;


use yii\web\AssetBundle;

class AuthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        "vendor/simplebar.min.css",
        "css/app.css",
        "css/app.rtl.css",
        "css/vendor-material-icons.css",
        "css/vendor-material-icons.rtl.css",
        "css/vendor-fontawesome-free.css",
        "css/vendor-fontawesome-free.rtl.css",

    ];

    public $js = [
        "vendor/popper.min.js",
        "vendor/simplebar.min.js",
        "vendor/dom-factory.js",
        "vendor/material-design-kit.js",
        "js/toggle-check-all.js",
        "vendor/bootstrap.min.js",
//        "js/check-selected-row.js",
//        "js/dropdown.js",
//        "js/sidebar-mini.js",
//        "js/app.js",
//        "js/app-settings.js",
    ];

    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap4\BootstrapAsset',
        'app\assets\VueAsset'
    ];
}