<?php

use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $gridOptions array */

?>
<?php Pjax::begin(['timeout' => 5000, 'id' => 'pjax-cart-container']); ?>
<?php echo GridView::widget($gridOptions); ?>
<?php Pjax::end(); ?>