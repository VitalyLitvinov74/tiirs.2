<?php


namespace app\assets;


use yii\web\AssetBundle;

class VueAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        "js/vue.js"
    ];
    public $css = [
        'css/vue.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap4\BootstrapAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}