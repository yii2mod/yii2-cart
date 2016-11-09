<?php

namespace yii2mod\cart\storage;

use yii2mod\cart\Cart;

/**
 * Interface StorageInterface
 * @package yii2mod\cart\storage
 */
interface StorageInterface
{
    /**
     * @param Cart $cart
     *
     * @return array|mixed
     */
    public function load(Cart $cart);

    /**
     * @param Cart $cart
     *
     * @return void
     */
    public function save(Cart $cart);
}