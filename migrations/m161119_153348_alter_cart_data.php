<?php

use yii\db\Migration;

class m161119_153348_alter_cart_data extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql' || $this->db->driverName === 'mariadb') {
            $this->alterColumn('{{%cart}}', 'cartData', 'longtext');
        }
    }

    public function down()
    {
        if ($this->db->driverName === 'mysql' || $this->db->driverName === 'mariadb') {
            $this->alterColumn('{{%cart}}', 'cartData', $this->text());
        }
    }
}
