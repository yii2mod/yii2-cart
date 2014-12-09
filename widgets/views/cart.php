<?php \yii\widgets\Pjax::begin(['timeout' => 3000]); ?>
<?php echo \yii\grid\GridView::widget([
    'dataProvider' => $cartDataProvider,
    'columns' => $cartColumns
]);
?>
<?php \yii\widgets\Pjax::end(); ?>