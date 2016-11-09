<?php

use yii\db\Migration;

class m161109_124936_rename_cart_table extends Migration
{
    public function up()
    {
        $this->renameTable('{{%Cart}}', '{{%cart}}');
    }

    public function down()
    {
        $this->renameTable('{{%cart}}', '{{%Cart}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
