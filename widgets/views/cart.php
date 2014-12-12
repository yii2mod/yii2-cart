<?php \yii\widgets\Pjax::begin(['timeout' => 3000, 'id' => 'pjax-cart-container']); ?>
<?php echo \yii\grid\GridView::widget($gridOptions); ?>
<?php \yii\widgets\Pjax::end(); ?>