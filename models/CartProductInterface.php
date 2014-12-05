<?php
/**
 *
 * @date   23.01.14
 */

namespace yii2mod\cart\models;

use yii2mod\cart\Cart;

/**
 * All 'purchasable' objects that can be added to the cart must implement this interface.
 *
 * @package yii2mod\cart\models
 */
interface CartProductInterface extends CartItemInterface
{
    /**
     * Returns the price of the element. This should include multiplication with any quantity attributes
     *
     * @return mixed
     */
    public function getTotalPrice();
}