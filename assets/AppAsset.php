<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        "css/bootstrap.min.css",
        "css/jquery-ui.min.css",
        "css/metisMenu.min.css",
        "css/icons.min.css",
        "css/app.min.css",
    ];

    public $js = [
        "js/jquery.min.js",
        "js/jquery-ui.min.js",
        "js/bootstrap.bundle.min.js",
        "js/metismenu.min.js",
        "js/waves.js",
        "js/feather.min.js",
        "js/jquery.slimscroll.min.js",
        "pages/jquery.responsive-table.init.js"
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\VueAsset'
    ];
}
