Shopping cart extension for Yii2
===============================

This extension adds shopping cart for Yii framework 2.0

[![Latest Stable Version](https://poser.pugx.org/yii2mod/yii2-cart/v/stable)](https://packagist.org/packages/yii2mod/yii2-cart) [![Total Downloads](https://poser.pugx.org/yii2mod/yii2-cart/downloads)](https://packagist.org/packages/yii2mod/yii2-cart) [![License](https://poser.pugx.org/yii2mod/yii2-cart/license)](https://packagist.org/packages/yii2mod/yii2-cart)
[![Code Climate](https://codeclimate.com/github/yii2mod/yii2-cart/badges/gpa.svg)](https://codeclimate.com/github/yii2mod/yii2-cart)

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
            'class' => 'yii2mod\cart\Cart'
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

    public function getId()
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

// render the contents of the cart with default parameters
echo \yii2mod\cart\widgets\CartGrid::widget();
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

