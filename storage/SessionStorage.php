<?php

namespace yii2mod\cart\storage;

use Yii;
use yii\base\Object;
use yii2mod\cart\Cart;

/**
 * Class SessionStorage
 * @property \yii\web\Session session
 * @package yii2mod\cart\cart
 */
class SessionStorage extends Object implements StorageInterface
{
    /**
     * @var string
     */
    public $key = 'cart';

    /**
     * @inheritdoc
     */
    public function load(Cart $cart)
    {
        $cartData = [];
        if (false !== ($session = ($this->session->get($this->key, false)))) {
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
        $this->session->set($this->key, $sessionData);
    }

    /**
     * @return \yii\web\Session
     */
    public function getSession()
    {
        return Yii::$app->get('session');
    }
}