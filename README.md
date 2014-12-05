Shopping cart extension for Yii2
=========

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

// add a discount object to the cart. AR model is implementing CartDiscountInterface
$cart->add(Discount::find(1));

// returns the sum of all cart item prices
$sum = $cart->getTotalDue();

// returns the sum of all 'vat' attributes (or return values of getVat()) from all models in the cart.
$totalVat = $cart->getAttributeTotal('vat');

// clear the cart
$cart->clear();

// render the contents of the cart with default parameters
echo \yii2mod\shop\widgets\CartGridView::widget([
    'cart' => $cart,
]);
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

### Creating orders
The cart object can easily be converted into orders (AR objects that implement the `OrderInterface`).
```php
$order = new Order([
	'user_id' = \Yii::$app->user->id,
	'status' => 'new',
]);
\Yii::$app->cart->createOrder($order);
```
This calls the `saveFromCart` method from your Order class, which could look something like this.
```php
public function saveFromCart(Cart $cart)
{
    $transaction = $this->getDb()->beginTransaction();
    try
    {
        $this->due_amount = $cart->getTotalDue(false);
        if (!$this->save()) {
            throw new \RuntimeException('Could not save order model');
        }

        foreach ($cart->getItems() as $item) {
            // create and save "order line" objects looking up necessary attributes from $item
        }
        $transaction->commit();
    }
    catch (\Exception $exception)
    {
        $transaction->rollback();
        throw $exception;
    }
}
```

