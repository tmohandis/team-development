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
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap.min.css',
        'css/mdb.min.css',
        'css/datatables.min.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/site.js',
        'js/fontawesome.js',
        'js/datatables.min.js',
        'js/popper.min.js',
        'js/mdb.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
