<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii2 Shopping Cart Extension</h1>
    <br>
</p>

This extension adds shopping cart for Yii framework 2.0


[![Latest Stable Version](https://poser.pugx.org/yii2mod/yii2-cart/v/stable)](https://packagist.org/packages/yii2mod/yii2-cart) [![Total Downloads](https://poser.pugx.org/yii2mod/yii2-cart/downloads)](https://packagist.org/packages/yii2mod/yii2-cart) [![License](https://poser.pugx.org/yii2mod/yii2-cart/license)](https://packagist.org/packages/yii2mod/yii2-cart)
[![Build Status](https://travis-ci.org/yii2mod/yii2-cart.svg?branch=master)](https://travis-ci.org/yii2mod/yii2-cart)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yii2mod/yii2-cart/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yii2mod/yii2-cart/?branch=master)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii2mod/yii2-cart "*"
```

or add

```
"yii2mod/yii2-cart": "*"
```

to the require section of your `composer.json` file.

### Configuration

1) Configure the ```cart``` component:
```php
return [
    //....
    'components' => [
        'cart' => [
            'class' => 'yii2mod\cart\Cart',
            // you can change default storage class as following:
            'storageClass' => [
                'class' => 'yii2mod\cart\storage\DatabaseStorage',
                // you can also override some properties 
                'deleteIfEmpty' => true
            ]
        ],
    ]
];
```
2) Create the Product Model that implements an `CartItemInterface`:
```php
class ProductModel extends ActiveRecord implements CartItemInterface
{

    public function getPrice()
    {
        return $this->price;
    }

    public function getLabel()
    {
        return $this->name;
    }

    public function getUniqueId()
    {
        return $this->id;
    }
}
```

> If you use the yii2mod\cart\storage\DatabaseStorage as ```storageClass``` then you need to apply the following migration:
```php
php yii migrate --migrationPath=@vendor/yii2mod/yii2-cart/migrations
```

### Using the shopping cart
Operations with the shopping cart are very straightforward when using a models that implement one of the two cart interfaces.
The cart object can be accessed under `\Yii::$app->cart` and can be overridden in configuration if you need to customize it.
```php
// access the cart from "cart" subcomponent
$cart = \Yii::$app->cart;

// Product is an AR model implementing CartProductInterface
$product = Product::findOne(1);

// add an item to the cart
$cart->add($product);

// returns the sum of all 'vat' attributes (or return values of getVat()) from all models in the cart.
$totalVat = $cart->getAttributeTotal('vat');

// clear the cart
$cart->clear();

```

#### View Cart Items

You can use the `CartGrid` widget for generate table with cart items as following:
```php
<?php echo \yii2mod\cart\widgets\CartGrid::widget([
    // Some widget property maybe need to change. 
    'cartColumns' => [
        'id',
        'label',
        'price'
    ]
]); ?>

```

#### Items in the cart
Products/items that are added to the cart are serialized/unserialized when saving and loading data from cart storage.
If you are using Active Record models as products/discounts, make sure that you are omitting any unnecessary references from
the serialized data to keep it compact.

```php
// get all items from the cart
$items = $cart->getItems();

// get only products
$items = $cart->getItems(Cart::ITEM_PRODUCT);

// loop through cart items
foreach ($items as $item) {
    // access any attribute/method from the model
    var_dump($item->getAttributes());

    // remove an item from the cart by its ID
    $cart->remove($item->uniqueId)
}
```

#### Get Number of Products in Cart

You can use the `getCount` to get count as this example:

```php
// get count of all products in cart:
$items = $cart->getCount();

// get count of Specific Item Type:
$items = $cart->getCount(Cart::ITEM_PRODUCT);
```
