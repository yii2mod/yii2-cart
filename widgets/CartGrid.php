<?php
namespace yii2mod\cart\widgets;

use yii\base\Widget;
use yii\data\ArrayDataProvider;
use yii2mod\cart\assets\CartAsset;
use yii2mod\cart\Cart;

/**
 * Class Cart
 * @package yii2mod\cart\widgets
 */
class CartGrid extends Widget
{
    /**
     * @var
     */
    public $cartDataProvider;
    /**
     * @var
     */
    public $cartColumns;


    /**
     * @var string Only items of that type will be rendered. Defaults to Cart::ITEM_PRODUCT
     */
    public $itemType = Cart::ITEM_PRODUCT;

    /**
     * Setting defaults
     */
    public function init()
    {
        $cart = \Yii::$app->get('cart');

        CartAsset::register($this->view);

        if (!isset($this->cartDataProvider)) {
            $this->cartDataProvider = new ArrayDataProvider([
                'allModels' => $cart->getItems($this->itemType),
                'pagination' => false,
            ]);
        }
        $this->cartColumns = [
            'id',
            'label',
        ];
    }

    /**
     * @return string
     */
    public function run()
    {
        return $this->render('cart', [
            'cartDataProvider' => $this->cartDataProvider,
            'cartColumns' => $this->cartColumns,
        ]);
    }
}