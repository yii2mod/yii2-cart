<?php

use yii\db\Migration;

class m160516_095943_init extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql' || $this->db->driverName === 'mariadb') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%Cart}}', [
            'sessionId' => $this->string(),
            'cartData' => $this->text(),
            'PRIMARY KEY (`sessionId`)',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%Cart}}');
    }
}
