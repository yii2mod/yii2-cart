<?php
/**
 *
 * @date   4.02.14
 */

namespace yii2mod\cart\models;

use yii2mod\cart\Cart;

/**
 * All objects that can be added to the cart and that have any special effect to the cart or cart
 * price (e.g. discounts) should implement this interface
 *
 * @package yii2mod\cart\models
 */
interface CartDiscountInterface extends CartItemInterface
{
    /**
     * @param Cart        $cart
     * @param integer|float $cartTotalSum
     *
     * @return void
     */
    public function applyToCart(Cart $cart, &$cartTotalSum);
} 