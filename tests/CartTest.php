<?php

namespace yii2mod\cart\tests;

use Yii;
use yii2mod\cart\storage\StorageInterface;
use yii2mod\cart\tests\data\Product;

/**
 * Class CartTest
 *
 * @package yii2mod\cart\tests
 */
class CartTest extends TestCase
{
    public function testEmptyCart()
    {
        $this->assertEmpty(Yii::$app->cart->getItems());
    }

    public function testAddItem()
    {
        $cart = Yii::$app->cart;
        $product = Product::findOne(1);
        $cart->add($product);

        $this->assertContains($product, $cart->getItems());
    }

    public function testRemoveItem()
    {
        $cart = Yii::$app->cart;
        $product = Product::findOne(1);
        $cart->add($product);

        $this->assertContains($product, $cart->getItems());

        $cart->remove($product->getUniqueId());
        $this->assertEmpty($cart->getItems());
    }

    public function testClearCart()
    {
        $cart = Yii::$app->cart;
        $product = Product::findOne(1);
        $cart->add($product);

        $this->assertEquals(1, $cart->getCount());

        $cart->clear();
        $this->assertEmpty($cart->getItems());
    }

    public function testGetAttributeTotalValue()
    {
        $cart = Yii::$app->cart;
        $product = Product::findOne(1);
        $cart->add($product);

        $this->assertEquals(100, $cart->getAttributeTotal('price'));
    }

    public function testGetItems()
    {
        $cart = Yii::$app->cart;
        $product = Product::findOne(1);
        $cart->add($product);

        $items = $cart->getItems();

        $this->assertCount(1, $items);
        $this->assertEquals('Amazon Kindle', $items[1]['name']);
    }

    public function testGetStorage()
    {
        $this->assertInstanceOf(StorageInterface::class, Yii::$app->cart->getStorage());
    }
}
