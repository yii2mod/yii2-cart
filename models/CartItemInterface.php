<?php

namespace yii2mod\cart\models;

/**
 * All objects that can be added to the cart must implement this interface
 * @package yii2mod\cart\models
 */
interface CartItemInterface
{
    /**
     * Returns the price for the cart item
     * @return integer
     */
    public function getPrice();

    /**
     * Returns the label for the cart item (displayed in cart etc)
     * @return string
     */
    public function getLabel();

    /**
     * Returns unique id to associate cart item with product
     * @return string
     */
    public function getUniqueId();
}