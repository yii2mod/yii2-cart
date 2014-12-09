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
    public $sourcePath = '@vendor/yii2mod/yii2-cart/assets';

    /**
     * @var array
     */
    public $js = [
        'js/cart.js'
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
