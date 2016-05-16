<?php

namespace yii2mod\cart\storage;

use yii2mod\cart\Cart;

/**
 * Interface StorageInterface
 * @package yii2mod\cart\cart
 */
interface StorageInterface
{

    /**
     * @param \yii2mod\cart\Cart $cart
     *
     * @return void
     */
    public function load(Cart $cart);

    /**
     * @param \yii2mod\cart\Cart $cart
     *
     * @return void
     */
    public function save(Cart $cart);
}