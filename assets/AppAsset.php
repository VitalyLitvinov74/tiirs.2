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
    public $js = [
        "js/bootstrap.bundle.min.js",
        "js/feather.min.js",
        "js/jquery.core.js",
        "js/jquery.min.js",
        "js/jquery.slimscroll.min.js",
        "js/jquery-ui.min.js",
        "js/metismenu.min.js",
        "js/simplebar.min.js",
        "js/waves.js",
        "js/app.js",
    ];
    public $css = [
        "css/app.css",
        "css/app-dark.css",
        "css/app-dark-rtl.css",
        "css/app-rtl.css",
        "css/bootstrap.css",
        "css/bootstrap-dark.css",
        "css/icons.css",
        "css/jquery-ui.min.css",
        "css/metisMenu.min.css",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
