<?php yii\widgets\Pjax::begin([
    'id' => 'cartContainer',
    'enablePushState' => false,
    'timeout' => 3000,
    'clientOptions' => ['url' => '/cart/view']
]); ?>
<?php echo yii2mod\cart\widgets\CartGridView::widget([
    'cart' => $cart
]); ?>
<?php Pjax::end(); ?>
