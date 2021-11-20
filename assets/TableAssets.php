<?php


namespace app\assets;


use yii\web\AssetBundle;

class TableAssets extends AssetBundle
{
    public $js = [
        "plugins/tiny-editable/mindmup-editabletable.js",
        "plugins/tiny-editable/numeric-input-example.js",
        "plugins/bootable/bootstable.js",
        "pages/jquery.tabledit.init.js"
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}