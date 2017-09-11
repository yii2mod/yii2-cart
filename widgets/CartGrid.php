<?php

namespace yii2mod\cart\widgets;

use Yii;
use yii\base\Widget;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii2mod\cart\Cart;

/**
 * Class Cart
 *
 * @package yii2mod\cart\widgets
 */
class CartGrid extends Widget
{
    /**
     * @var \yii\data\BaseDataProvider
     */
    public $cartDataProvider;

    /**
     * @var array GridView columns
     */
    public $cartColumns = ['id', 'label'];

    /**
     * @var array GridView options
     */
    public $gridOptions = [];

    /**
     * @var string Only items of that type will be rendered. Defaults to Cart::ITEM_PRODUCT
     */
    public $itemType = Cart::ITEM_PRODUCT;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $cart = Yii::$app->get('cart');

        if (!isset($this->cartDataProvider)) {
            $this->cartDataProvider = new ArrayDataProvider([
                'allModels' => $cart->getItems($this->itemType),
                'pagination' => false,
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('cart', [
            'gridOptions' => $this->getGridOptions(),
        ]);
    }

    /**
     * Return grid options
     *
     * @return array
     */
    public function getGridOptions(): array
    {
        return ArrayHelper::merge($this->gridOptions, [
            'dataProvider' => $this->cartDataProvider,
            'columns' => $this->cartColumns,
        ]);
    }
}
