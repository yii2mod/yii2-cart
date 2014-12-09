Shopping cart extension for Yii2
=========
[![Code Climate](https://codeclimate.com/github/yii2mod/yii2-cart/badges/gpa.svg)](https://codeclimate.com/github/yii2mod/yii2-cart) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yii2mod/yii2-cart/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yii2mod/yii2-cart/?branch=master)

@todo: upgrade readme

### Using the shopping cart
Operations with the shopping cart are very straightforward when using a models that implement one of the two cart interfaces.
The cart object can be accessed under `\Yii::$app->cart` and can be overridden in configuration if you need to customize it.
```php
// access the cart from "cart" subcomponent
$cart = \Yii::$app->cart;

// Product is an AR model implementing CartProductInterface
$product = Product::find(1);

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

