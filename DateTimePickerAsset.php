<?php
/**
 * Created by PhpStorm.
 * User: huijiewei
 * Date: 15/9/4
 * Time: 17:10
 */

namespace huijiewei\datetimepicker;

use yii\web\AssetBundle;

class DateTimePickerAsset extends AssetBundle
{
    public $sourcePath = '@huijiewei/datetimepicker/assets';

    public $css = [
        'css/bootstrap-datetimepicker.min.css',
    ];

    public $js = [
        'js/bootstrap-datetimepicker.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}