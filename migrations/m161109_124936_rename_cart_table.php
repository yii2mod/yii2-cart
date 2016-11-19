<?php

use yii\db\Migration;

class m161109_124936_rename_cart_table extends Migration
{
    public function up()
    {
        if (Yii::$app->db->schema->getTableSchema('cart') === null) {
            $this->renameTable('{{%Cart}}', '{{%cart}}');
        }
    }

    public function down()
    {
        if (Yii::$app->db->schema->getTableSchema('Cart') === null) {
            $this->renameTable('{{%cart}}', '{{%Cart}}');
        }
    }
}
