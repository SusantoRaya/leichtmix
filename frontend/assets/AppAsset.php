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
        'css/site.css',
        'css/bootstrap.min.css',
        'css/fontawesome/css/all.css',
        // 'css/fontawesome/css/brands.css',
        // 'css/fontawesome/css/regular.css',
        'css/fontawesome/css/fontawesome.css',
        'css/plugins.css',
        'css/shortcode/shortcodes.css',
        'css/style.css',
        'css/responsive.css',
        'css/custom.css'

    ];
    public $js = [
        'js/vendor/modernizr-3.11.2.min.js',
        'js/vendor/jquery-3.6.0.min.js',
        'js/vendor/jquery-migrate-3.3.2.min.js',
        'js/vendor/jquery.waypoints.js',
        'js/bootstrap.bundle.min.js',
        'js/plugins.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
