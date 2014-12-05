<?php
/**
 * @date   23.01.14
 */

namespace yii2mod\cart\storage;

use yii2mod\cart\Cart;

/**
 * Class SessionStorage
 * @package yii2mod\cart\cart
 */
class Session implements StorageInterface
{
    /**
     * @var string
     */
    public $cartVar = 'cart';

    /**
     * @inheritdoc
     */
    public function load(Cart $cart)
    {
        $cartData = [];
        if (false !== ($session = ($cart->session->get($this->cartVar, false)))) {
            $cartData = unserialize($session);
        }
        return $cartData;
    }

    /**
     * @inheritdoc
     */
    public function save(Cart $cart)
    {
        $sessionData = serialize($cart->getItems());
        $cart->session->set($this->cartVar, $sessionData);
    }
}