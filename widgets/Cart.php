<?php
namespace yii2mod\cart\widgets;

use yii\base\Widget;

/**
 * Class Cart
 * @package yii2mod\cart\widgets
 */
class Cart extends Widget
{
    /**
     * @var
     */
    public $cart;

    /**
     * Setting defaults
     */
    public function init()
    {
        $this->cart = \Yii::$app->get('cart');
    }

    /**
     * @return string
     */
    public function run()
    {
        return $this->render('cart', [
            'cart' => $this->cart
        ]);
    }
}