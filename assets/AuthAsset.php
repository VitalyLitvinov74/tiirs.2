<?php


namespace app\assets;


use yii\web\AssetBundle;

class AuthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        "auth/vendor/simplebar.min.css",
        "auth/css/app.css",
        "auth/css/app.rtl.css",
        "auth/css/vendor-material-icons.css",
        "auth/css/vendor-material-icons.rtl.css",
        "auth/css/vendor-fontawesome-free.css",
        "auth/css/vendor-fontawesome-free.rtl.css",

    ];

    public $js = [
        "/auth/vendor/popper.min.js",
        "/auth/vendor/simplebar.min.js",
        "/auth/vendor/dom-factory.js",
        "/auth/vendor/material-design-kit.js",
        "/auth/js/toggle-check-all.js",
        "/auth/vendor/bootstrap.min.js",
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\VueAsset'
    ];
}