<?php
namespace yii2mod\cart\widgets;

use Yii;
use yii\data\ArrayDataProvider;
use yii2mod\cart\assets\CartAsset;
use yii2mod\cart\Cart;

/**
 * Class CartGridView. Provides the default data provider with no pagination and all cart models
 * @package yii2mod\cart\widgets
 */
class CartGridView extends GridView
{
    /**
     * @var Cart
     */
    public $cart;

    /**
     * @var string Only items of that type will be rendered. Defaults to Cart::ITEM_PRODUCT
     */
    public $itemType = Cart::ITEM_PRODUCT;

    /**
     * @inheritdoc
     */
    public function init()
    {
        CartAsset::register($this->view);

        if (!isset($this->dataProvider)) {
            $this->dataProvider = new ArrayDataProvider([
                'allModels' => $this->cart->getItems($this->itemType),
                'pagination' => false,
            ]);
        }
        $this->columns = [
            'name',
            'quantityCart',
            'priceCart',
        ];
        parent::init();
    }
}