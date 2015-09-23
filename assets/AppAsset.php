<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/jqueryUI/jquery-ui.min.css',
        'css/jqueryUI/jquery-ui.structure.min.css',
        'css/jqueryUI/jquery-ui.theme.min.css',
        'css/jquery.dropzone.css',
        'css/site.css',
    ];
    public $js = [
        'js/jqueryUI/jquery-ui.min.js',
        'js/jquery.dropzone.js',
        'js/__init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
