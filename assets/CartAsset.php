<?php

namespace yii2mod\cart\assets;

use yii\web\AssetBundle;
use yii\web\View;


/**
 * Class CartAsset
 * @package app\assets
 */
class CartAsset extends AssetBundle
{

    /**
     * @var string
     */
    public $basePath = '@webroot';

    /**
     * @var string
     */
    public $baseUrl = '@web';

    /**
     * @var array
     */
    public $js = [

    ];

    public $jsOptions = [
        'position' => View::POS_END
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
